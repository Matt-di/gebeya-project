<!-- Modal -->
<div class="modal fade" id="confirmModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1"
    aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confrim Operation</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure to delet all Products ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">No</button>
                <form action="{{ route('products.delete.all') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
