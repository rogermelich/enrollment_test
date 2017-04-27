@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Wizard Enrollment
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <wizard>
                <wizard-step title="Usuari" active="true">
                    Step 1: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, laborum.
                    <user></user>
                </wizard-step>
                <wizard-step title="Dades Personals">
                    Step 2: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, aut!
                    <person></person>
                </wizard-step>
                <wizard-step title="Estudis i Curs">
                    Step 3: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, harum.
                    <study></study>
                    <course></course>
                </wizard-step>
                <wizard-step title="Moduls Professionals">
                    Step 4: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, quod.
                    <module></module>
                </wizard-step>
                <wizard-step title="Unitats Formatives">
                    Step 5: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, tempore.
                    <submodule></submodule>
                </wizard-step>
            </wizard>

        </div>
    </div>
@endsection