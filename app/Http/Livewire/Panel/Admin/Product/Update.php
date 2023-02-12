<?php

namespace App\Http\Livewire\Panel\Admin\Product;

use App\Http\Requests\product\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\SweatAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component {
	use SweatAlert;
	use WithFileUploads;
	
	public Product $product;
	public         $title;
	public         $price;
	public         $discount;
	public         $link;
	public         $order_count;
	public         $stock;
	public bool    $special      = false;
	public bool    $gift         = false;
	public bool    $is_published = false;
	public         $image;
	public         $category_id;
	public         $sub_category_id;
	public         $child_category_id;
	public         $brand_id;
	public         $type_of_quality;
	public         $categories;
	public         $subCategories;
	public         $childCategories;
	public         $short_description;
	public         $description;
	public         $weight;
	public         $brands;
	protected      $listeners    = [
		'getSubCategories' ,
		'getChildCategories' ,
	];
	
	protected function rules () {
		return ( new UpdateProductRequest() )->rules($this->product->id);
	}
	
	protected function messages () {
		return ( new UpdateProductRequest() )->messages();
	}
	
	public function mount ( string $slug ) {
		$this->product = Product::query()
								->where('slug' , $slug)
								->firstOrFail();
		if ( $this->product ) {
			$this->loadData($this->product);
		}
		$this->categories = Category::query()
									->where('is_published' , 1)
									->get();
		$this->brands = Brand::where('is_published' , 1)
							 ->latest()
							 ->get();
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
	
	public function hydrate () {
		$this->dispatchBrowserEvent('hydrate');
	}
	
	public function update () {
		$data = $this->validate();
		$data[ 'brand_id' ] = $this->brand_id;
		$data[ 'child_category_id' ] = $this->child_category_id;
		$data[ 'sub_category_id' ] = $this->sub_category_id;
		$data[ 'category_id' ] = $this->category_id;
		$data[ 'short_description' ] = $this->short_description;
		$data[ 'description' ] = $this->description;
		$this->product->fill($data);
		$this->product->save();
		if ( $this->image ) {
			$this->product->addMedia($this->image)
						  ->usingName($this->product->title)
						  ->toMediaCollection(__('messages.product.media-collection'));
		}
		activity()
			->performedOn($this->product)
			->withProperties($this->product)
			->log(__('messages.global.logs.update'));
		$this->image = null;
		$this->popupDialog([
							   'title' => __('alert-icon.title.success') ,
							   'text' => __('messages.product.update') ,
							   'icon' => __('alert-icon.icon.success') ,
							   'route' => route('admin.product.index') ,
						   ]);
	}
	
	public function render () {
		return view('livewire.panel.admin.product.update');
	}
	
	public function loadData ( Product $product ) {
		if ( $product->id ) {
			$this->title = $product->title;
			$this->price = $product->price;
			$this->discount = $product->discount;
			$this->is_published = $product->is_published;
			$this->special = $product->special;
			$this->gift = $product->gift;
			$this->description = $product->description;
			$this->short_description = $product->short_description;
			$this->category_id = $product->category_id;
			$this->sub_category_id = $product->sub_category_id;
			$this->child_category_id = $product->child_category_id;
			$this->brand_id = $product->brand_id;
			$this->link = $product->link;
			$this->order_count = $product->order_count;
			$this->weight = $product->weight;
			$this->stock = $product->stock;
			$this->type_of_quality = $product->type_of_quality;
			$this->description = $product->description;
			$this->short_description = $product->short_description;
			$this->getSubCategories();
			$this->getChildCategories();
		}
	}
}
