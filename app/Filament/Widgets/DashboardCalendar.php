<?php

namespace App\Filament\Widgets;

use App\Models\Dokumen;
use Illuminate\Support\Collection;
use Guava\Calendar\ValueObjects\Event;
use Guava\Calendar\Widgets\CalendarWidget;

class DashboardCalendar extends CalendarWidget
{
    protected string $calendarView = 'dayGridMonth';

    public function getEvents(array $fetchInfo = []): Collection|array
    {
        return Dokumen::getDokumenEvents();
    }

}
