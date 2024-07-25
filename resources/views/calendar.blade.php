@extends($layouts)


@section('style')
    <!-- Inclure les styles CSS de FullCalendar -->
    <link rel="stylesheet" href="{{ asset('assets/bundles/fullcalendar/fullcalendar.min.css') }}">
@endsection


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Calendrier</h4>
                        </div>
                        <div class="card-body">
                            <div class="fc-overflow">
                                <div id="myEvent"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script_other')
    <!-- Inclure les scripts JS de FullCalendar et ses dépendances -->
    <script src="{{ asset('assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>

    <script>
        var calendar = $('#myEvent').fullCalendar({
            height: 'auto',
            defaultView: 'month',
            editable: true,
            selectable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
            },
            dayNamesShort: moment.weekdaysShort(
                true), // Utilisez les noms des jours abrégés
            monthNames: moment.months(true), // Utilisez les noms des mois
            // locale: '{{ app()->getLocale() }}',

            events: [
                @foreach ($arr as $ca)
                    {
                        title: "{{ $ca->name }}",
                        start: new Date("{{ $ca->date_debut }}T{{ $ca->heure_debut }}:00"),
                        end: new Date("{{ $ca->date_fin }} {{ $ca->heure_fin }}"),
                        backgroundColor: "blue",
                        url: '{{ route('welcome')}}',
                    },
                @endforeach
            ],
            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url);
                    return false;
                }
            },
        });
    </script>
@endpush
