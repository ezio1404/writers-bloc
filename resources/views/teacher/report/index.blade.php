@extends('layouts.teacher')


@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    .dt-button{
        padding: 1rem;
        border: 1 gray solid;
    }
    .dt-button:hover{
        background: rgba(211,211,211,.5);
    }
    .paginate_button{
        padding: .5rem !important;
        margin: 0 !important;
    }
</style>
@endsection

@section('content')
<nav class="text-black" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="#">Student</a>
        </li>

    </ol>
</nav>

<div class="mt-16">


    <div class="mt-10">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table  class="min-w-full divide-y divide-gray-200 datatable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student Id
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student Fullname
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>


                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-large font-medium text-gray-900">
                                            Student Id
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900"> Name</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900"> Email</div>
                                    </td>
                                </tr>
                                {{-- @forelse ($students as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-large font-medium text-gray-900">
                                            {{$student->id}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900"> {{$student->name}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <div class="text-sm text-gray-900"> {{$student->email}}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex">
                                        <a href="{{ route('teacher-show-student',$student->id)}}"
                                            class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 p-2 rounded mr-2"><i
                                                class="far fa-edit"></i> Grade</a>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="7">
                                        <div class="text-large font-medium text-gray-900 text-center">
                                            <blockquote class="italic">Choose a job you love, and you will never have to
                                                work a day in your life.</blockquote>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection


@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('js/datatable/buttons.print.min.js')}}"></script>
<script src="{{ asset('js/datatable/buttons.flash.min.js')}}"></script>
<script src="{{ asset('js/datatable/buttons.html5.min.js')}}"></script>
<script src="{{ asset('js/datatable/jszip.min.js')}}"></script>
<script src="{{ asset('js/datatable/pdfmake.min.js')}}"></script>
<script src="{{ asset('js/datatable/vfs_fonts.js')}}"></script>
<script type="text/javascript">
    $(function () {

      var table = $('.datatable').DataTable({
        dom: 'Bfrtip',
          processing: true,
          serverSide: true,
          ajax: "{{ route('teacher-report-getStudents') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
          ],
          select: true,
        colReorder: true,
        buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
      });

    });
  </script>
@endsection
