<?php

namespace App\Http\Livewire\Panel\Admin\Product;

use App\Http\Requests\product\AddProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component {
	use SweatAlert;
	use WithFileUploads;
	
	public      $title;
	public      $price;
	public      $discount;
	public      $link;
	public      $order_count;
	public      $stock;
	public bool $special      = false;
	public bool $gift         = false;
	public bool $is_published = false;
	public      $image;
	public      $category_id;
	public      $sub_category_id;
	public      $child_category_id;
	public      $brand_id;
	public      $type_of_quality;
	public      $categories;
	public      $subCategories;
	public      $childCategories;
	public      $short_description;
	public      $description;
	public      $weight;
	public      $brands;
	protected   $listeners    = [
		'getSubCategories' ,
		'getChildCategories' ,
	];
	
	public function mount () {
		$this->categories = Category::query()
									->where('is_published' , 1)
									->get();
		$this->brands = Brand::where('is_published' , 1)
							 ->latest()
							 ->get();
		$this->subCategories = collect();
		$this->childCategories = collect();
	}
	
	protected function rules () {
		return ( new AddProductRequest() )->rules();
	}
	
	protected function messages () {
		return ( new AddProductRequest() )->messages();
	}
	
	public function hydrate () {
		$this->dispatchBrowserEvent('hydrate');
	}
	
	public function getSubCategories () {
		if ( !empty($this->category_id) ) {
			$this->subCategories = SubCategory::where('category_id' , $this->category_id)
											  ->where('is_published' , 1)
											  ->get();
		}
	}
	
	public function getChildCategories () {
		if ( !empty($this->sub_category_id) ) {
			$this->childCategories = ChildCategory::where('sub_category_id' , $this->sub_category_id)
												  ->where('is_published' , 1)
												  ->get();
		}
	}
	
	public function store () {
		$data = $this->validate();
		$data[ 'brand_id' ] = $this->brand_id;
		$data[ 'child_category_id' ] = $this->child_category_id;
		$data[ 'sub_category_id' ] = $this->sub_category_id;
		$data[ 'category_id' ] = $this->category_id;
		$data[ 'short_description' ] = $this->short_description;
		$data[ 'description' ] = $this->description;
		$product = new Product();
		$product->fill($data);
		$product->save();
		$product->addMedia($this->image)
				->usingName($product->title)
				->toMediaCollection(__('messages.product.media-collection'));
		activity()
			->performedOn($product)
			->withProperties($product)
			->log(__('messages.global.logs.create'));
		$this->image = null;
		$this->popupDialog([
							   'title' => __('alert-icon.title.success') ,
							   'text' => __('messages.product.creation') ,
							   'icon' => __('alert-icon.icon.success') ,
							   'route' => route('admin.product.index') ,
						   ]);
	}
	
	public function render () {
		return view('livewire.panel.admin.product.form');
	}
}
