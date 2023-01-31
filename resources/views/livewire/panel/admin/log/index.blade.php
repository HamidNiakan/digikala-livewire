@section('title','گزارشات سیستم')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="#">جستجو:</a>
                <a class="t-header-search">
                    <form>
                        <input type="text" wire:model.debounce.10000="search" class="text" placeholder="جستجو ...">
                    </form>
                </a>
            </div>
        </div>
        <div class="row no-gutters  ">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام لاگ</th>
                            <th>نوع لاگ</th>
                            <th>نام مدل</th>
                            <th>شناسه مدل</th>
                            <th>نام کاربر</th>
                            <th>توضیحات</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody wire:init="loadActivites">
                        @if($this->readToLoad)
                            @if($activities->isNotEmpty())
                                @foreach($activities as $activity)
                                    <livewire:panel.admin.log.data-table :activity="$activity" :key="time().$activity->id"/>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        اطلاعات یافت نشد
                                    </td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                    @if($this->readToLoad)
                        {{$activities->render()}}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
