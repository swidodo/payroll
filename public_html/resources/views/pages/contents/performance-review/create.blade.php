@extends('pages.dashboard')

@section('title', 'Performance Review')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Kpi Employee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('performance-review.index')}}">Performance Review</a></li>
                        <li class="breadcrumb-item active">Kpi Employee</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->


        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header">
                      <h3 class="card-title mb-0 py-3">KPI Employee</h3>
                      <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                        </div>
                      </div>
                    </div>
                    <!--begin::Form-->
                    <form class="form" action="{{route('performance-review.store')}}" method="POST">
                        @csrf
                      <div class="card-body">
                        <div class="form-group row">
                          <div class="col-lg-6">
                            {{-- <div class="form-group ">
                              <label class="label-font">Start Date :</label>
                              <input type="text" name="startdate" id="startdate" class="form-control form-control-sm" placeholder="Start Date">
                            </div>
                            <div class="form-group">
                              <label class="label-font">End Date :</label>
                              <input type="text" name="enddate" id="enddate" class="form-control form-control-sm" placeholder="End Date">
                            </div> --}}
                            <div class="form-group mb-4">
                              <label for="religion" class="label-font control-label" required="">Employee ID :</label>
                              <div class="form-group">
                                <select class="select" name="employee_id">
                                    <option value="0" selected>Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="pengetahuan" class=" label-font control-label" required="">PENGETAHUAN TENTANG PEKERJAAN</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="knowledge" id="pengetahuan">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="keterampilan" class="label-font control-label" required="">KETERAMPILAN UNTUK MELAKUKAN PEKERJAAN</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="skill" id="keterampilan">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="ketepatan" class="label-font control-label" required="">KECEPATAN DAN KETEPATAN WAKTU DALAM MENYELESAIKAN PEKERJAAN</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="accuracy" id="ketepatan">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="kualitas" class="label-font control-label" required="">KUALITAS PEKERJAAN : KECERMATAN DAN KERAPIAN</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="quality" id="kualitas">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="perawatan" class="label-font control-label" required="">PERAWATAN DAN PENGUNAAN PERALATAN</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="care" id="perawatan">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>

                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label for="kehandalan" class="label-font control-label" required="">KEHANDALAN : Kemampuan untuk melakukan pekerjaan</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="reliability" id="kehandalan">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-4">
                              <label for="metode" class="label-font control-label" required="">METODE BEKERJA : Prosedur untuk melakukan perkerjaan</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="working_method" id="metode">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-4">
                              <label for="fleksibilitas" class="label-font control-label" required="">FLEKSIBILITAS : Kemampuan untuk beradaptasi dan bekerja secara efektif dalam situasi dan kondisi pekerjaan yang berbeda - beda / berubah</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="flexibility" id="fleksibilitas">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-4">
                              <label for="inisiatif" class="label-font control-label" required="">INISIATIF : Kemauan untuk mengidentifikasi peluang / masalah tanpa menunggu perintah dan mengambil tindakan untuk merealisasikan</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="initiative" id="inisiatif">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-4">
                              <label for="kerjasama" class="label-font control-label" required="">KERJASAMA : Kemauan untuk bekerjasama dengan orang lain / anggota kelompok kerja</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="cooperation" id="kerjasama">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-4">
                              <label for="absensi" class="label-font control-label" required="">ABSENSI : Kehadiran di tempat kerja dan pengunaan waktu kerja</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="attendance" id="absensi">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-4">
                              <label for="komitment" class="label-font control-label" required="">KOMITMEN ORGANISASI : Kemampuan dan kemauan untuk menyelaraskan perilaku dengan peraturan dan kebutuhan perusahaan</label>
                              <div class="form-group">
                                <select class="form-control form-control-sm" name="organizational_commitment" id="komitment">
                                  <option value="0" selected="" disabled="">Change Value</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="label-font">Notes :</label>
                              <textarea name="notes" id="notes" class="form-control form-control-sm" placeholder="Notes"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <a href="{{route('performance-review.index')}}" class="btn btn-default mr-2">Cancel</a>
                      </div>
                    </form>
                    <!--end::Form-->
                  </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->


</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">

@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Select2 JS -->
    <script src="{{asset('assets/js/select2.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>


@endpush
