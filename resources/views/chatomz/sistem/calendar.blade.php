<x-mazer-layout title="CHATOMZ - Kalendar">
    <x-slot name="head">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/evocalendar/css/evo-calendar.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/evocalendar/css/evo-calendar.royal-navy.css')}}"/>
    </x-slot>
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Kalendar" active="Daftar Jadwal">
            </x-header>
            <section class="section">
                <div id="calendar"></div>
            </section>
        </div>
    
    </x-slot>
    <x-slot name="kodejs">
        <script src="{{ asset('vendor/evocalendar/js/evo-calendar.js')}}"></script>
        <script>
            // initialize your calendar, once the page's DOM is ready
            $(document).ready(function() {
                $('#calendar').evoCalendar({
                    theme:'Royal Navy', // Midnight Blue | Royal Navy | Orange Coral
                    format:'mm/dd/yyyy',
                    titleFormat:'MM yyyy',
                    eventHeaderFormat:'MM d, yyyy',
                    language:'en',
                    todayHighlight: true,
                    sidebarToggler: true,
                    sidebarDisplayDefault: false,
                    eventListToggler: true,
                    eventDisplayDefault: true,
                    dates: {
                        en: {
                            days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                            daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                            daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                            months: ["January", "February", "March", "April", "Mei", "June", "July", "August", "September", "October", "November", "December"],
                            monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            noEventForToday: "No event for today.. so take a rest! :)",
                            noEventForThisDay: "No event for this day.. so take a rest! :)"
                        }
                    },
                    calendarEvents: @json($data)
                });
            })
            </script>
    </x-slot>
</x-mazer-layout>
