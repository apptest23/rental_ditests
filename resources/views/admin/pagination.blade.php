@if ($paginator->hasPages())
    <div class="dataTables_wrapper">


   <!--  <div class="dataTables_info new_pagination " id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 14 entries</div> -->

   <div class="dataTables_info new_pagination " id="example2_info" role="status" aria-live="polite"> Showing {{($paginator->currentpage()-1)*$paginator->perpage()+1}} to {{(($paginator->currentpage()-1)*$paginator->perpage())+$paginator->count()}} of {{$paginator->total()}} entries</div>

  


    <div class="dataTables_paginate paging_simple_numbers new_pagination d-flex" id="example2_paginate">
       
        @if ($paginator->onFirstPage())

        <a class="paginate_button previous disabled page-link " aria-controls="example2" data-dt-idx="0" tabindex="0" id="example2_previous"><i class="fal fa-angle-left"></i></a>
           
        @else 
             <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="paginate_button previous page-link " aria-controls="example2" data-dt-idx="0" tabindex="0" id="example2_previous"><i class="fal fa-angle-left"></i></a>
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <a class="paginate_button page-link" aria-controls="example2" data-dt-idx="{{ $element }}" tabindex="0">{{ $element }}</a>
            @endif

        <!--    <div> -->
           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())

                        <a class="paginate_button current page-link" aria-controls="example2" data-dt-idx="1" tabindex="0">{{ $page }}</a>
                    @else
                      

                        <a href="{{ $url }}"class="paginate_button page-link" aria-controls="example2" data-dt-idx="1" tabindex="0">{{ $page }}</a>

                    @endif
                @endforeach
            @endif
        @endforeach

     <!--    </div> -->


        
        @if ($paginator->hasMorePages())

        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="paginate_button next page-link" aria-controls="example2" data-dt-idx="3" tabindex="0" id="example2_next"><i class="fal fa-angle-right"></i></a>
           
        @else
        <a class="paginate_button next disabled page-link" aria-controls="example2" data-dt-idx="3" tabindex="0" id="example2_next"><i class="fal fa-angle-right"></i></a>
        @endif
   </div>
</div>
@endif 


<style type="text/css">
.new_pagination a{
    margin: 0px 6px
}
.new_pagination .current{
    color: white!important;
   background-color: #1b3e41!important;
}
.dataTables_wrapper {
    display: flex;
    justify-content: space-between;
    padding: 57px 20px 0px;
}
</style>

  <!--  <div class="product-filter product-filter1">
                <div class="row row1">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="showing">
                            <p>Showing 1 to 6 of 12 (1 Pages)</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fal fa-angle-left"></i></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link active" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">...</li>
                            <li class="page-item">
                                <a class="page-link" href="#">10</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fal fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->