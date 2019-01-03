@foreach($nodes as $category)
    @if(!$category->isLeaf())
        <li>
            <a class="navbar-link">
                {{$category->name}}
            </a>

            <ul class="is-child-menu navbar-dropdown">
                @include('commons.menu-multi-level', ['nodes' => $category->children])
            </ul>

        </li>
    @else
        <li>
            <a class="navbar-item">
                {{$category->name}}
            </a>
        </li>
    @endif
@endforeach
