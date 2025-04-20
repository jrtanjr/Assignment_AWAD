@extends('layouts.standard')

@section('content')
<script>
    alert('Payment successful!');
    window.location.href = "{{ route('projects.show', $projectId) }}";
</script>
@endsection
