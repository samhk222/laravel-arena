<div class="card @if($type) card-{{$type}} @endif">
    @if($title)
        <div class="card-header">
            <h3 class="card-title">{!!  $title !!}</h3>
            @if($search || $minimize)
                <div class="card-tools">
                    @if($search)
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" wire:model.debounce.500ms="search_term" name="table_search"
                                   class="form-control float-right"
                                   placeholder="Pesquisar">

                            <div class="input-group-append" wire:click.prevent="search()">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    @endif
                    @if($minimize)
                        <button type="button" class="btn btn-sm" data-card-widget="collapse"
                                data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    @endif
                </div>
            @endif
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
    <!-- /.card-body -->


    @if($footer ?? '')
        {{ $footer }}
    @endif
</div>
