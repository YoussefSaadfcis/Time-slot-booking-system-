@if(session()->has('success'))
    <div id="success-alert" class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<script>
    // Automatically hide the success message after 8 seconds
    $(document).ready(function(){
        setTimeout(function(){
            $('#success-alert').fadeOut('slow');
        }, 8000); // 8000 milliseconds = 8 seconds
    });
</script>

