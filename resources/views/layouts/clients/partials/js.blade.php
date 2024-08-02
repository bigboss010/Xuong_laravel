<script src="{{ asset('assets/client/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/client/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/client/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/client/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/client/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/client/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/client/js/aos.js') }}"></script>
<script src="{{ asset('assets/client/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $(".delete-product").click(function(e) {
            e.preventDefault();

            var ele = $(this);
            if (confirm("Bạn chắc chắn muốn xóa pet này chứ?")) {
                $.ajax({
                    url: '{{ route('/.delete.pet.cart') }}', 
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("rowId")
                    },
                    success: function (response) {
                        if (response.success) {
                            ele.closest("tr").remove(); 
                            alert(response.success); 
                        } else {
                            alert(response.error); 
                        }
                    },
                    error: function (xhr) {
                        alert('An error occurred while deleting the item.');
                    }
                });
            }
        });
    });
</script>
@endsection
