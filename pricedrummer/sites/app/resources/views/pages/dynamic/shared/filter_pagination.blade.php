<ul class="pagination clearfix pull-right">
    @if($compare_products_data->current_page !=1)
        <li class="page-item first">
            <a id="pagination-first" href="{{$compare_products_data->first_page_url}}" class="page-link">
                First
            </a>
        </li>
        <li class="page-item prev ">
            <a id="pagination-prev" href="
                {{-- Generate the href for the next and Previous button --}}
            @if(empty($compare_products_data->first_page_url))
            {{'#'}}
            @else
            {{$compare_products_data->prev_page_url}}
            @endif
                    "
               class="page-link">
                Previous
            </a>
        </li>
    @endif
    <li class="page-item active">
        <a class="page-link disabled">
            Page {{$compare_products_data->current_page}} of {{$compare_products_data->last_page}}
        </a>
    </li>
    {{-- Hide next and last button if on the last page --}}
    @if($compare_products_data->current_page != $compare_products_data->last_page)
        <li class="page-item next">
            {{-- Generate the href for the next and last button --}}
            <a id="pagination-next" href="
                        @if(empty($compare_products_data->next_page_url))
            {{'#'}}
            @else
            {{$compare_products_data->next_page_url}}
            @endif
                    "
               class="page-link
                        @if(empty($compare_products_data->next_page_url))
               {{'disabled'}}
               @endif">
                Next
            </a>
        </li>
        <li class="page-item last"><a id="pagination-last" href="{{$compare_products_data->last_page_url}}" class="page-link">Last</a>
        </li>
    @endif
</ul>