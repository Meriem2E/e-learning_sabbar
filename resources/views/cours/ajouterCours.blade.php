@extends('layouts.app')
@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>COURS</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/cours">COURS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue">Entrer un cours </h4>
            <p class="mb-30 font-14"></p>
        </div>
    </div>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Choisissez une matiére</label>
            <select class="custom-select2 form-control  @error('matiere') is-invalid @enderror" name="matiere" id="matiere" style="width: 100%; height: 38px;">
                <option value="null" selected>Sélectionnez matière</option>
                <!--@if(count($matieres) > 0)
                @foreach($matieres as $matiere)
                <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                @endforeach
                @endif-->
            </select>
            @error('matiere')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
            @if (session('error'))
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">
                {{ session('error') }}
            </div>
            @endif
        </div>
        <div class="form-group">
            <label>Choisissez un niveau</label>
            <select class="custom-select2 form-control @error('niveau') is-invalid @enderror" name="niveau" id="niveau" style="width: 100%; height: 38px;">

            </select>
            @error('niveau')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Choisissez la ou les classes</label>
            <select class="custom-select2 form-control @error('classes') is-invalid @enderror" multiple="multiple"
            name="classes[]" id="classes"
            style="width: 100%; height: 38px;">
            </select>
            @error('classes')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Titre</label>
            <input class="form-control @error('titre') is-invalid @enderror" type="text" placeholder="Entrer le titre" name="titre">
            @error('titre')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea>
            <input class="form-control @error('description') is-invalid @enderror" type="text" placeholder="Entrer la description" name="description"></textarea>
            @error('description')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Fichier</label>
            <textarea>
            <input class="form-control @error('file') is-invalid @enderror" type="file" name="file"></textarea>
            @error('file')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-warning" style="margin-left:89%;" data-toggle="tooltip"
            title="Entrer les Questions"><i class="icon-copy fa fa-mail-forward" aria-hidden="true"></i>
        &nbsp;Suivant</button>
    </form>
</div>
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        $('#matiere').on('change',function(e) {

         var matiere_id = e.target.value;

         $.ajax({

               url:"{{ route('classe_niveau') }}",
               type:"POST",
               data: {
                matiere_id: matiere_id
               },

               success:function (data) {

                $('#niveau').empty();
                $('#classes').empty();

                $.each(data.matiere[0].niveaux,function(index,niveau){

                    $('#niveau').append('<option value="'+niveau.id+'">'+niveau.nom+'</option>');
                });
                $.each(data.matiere[0].classes,function(index,classe){

                    $('#classes').append('<option value="'+classe.id+'">'+classe.nom+'</option>');
                });

               }
           });
        });

    });
</script>
@endsection
@endsection
