<?php
    use Illuminate\Support\Carbon;
?>
<div class="!rounded-none card custom-card">
    <div class="card-header">
        <h2>
            {{ $row->title }}
        </h2>
    </div>
    <div class="card-body text-center">
        <div class="grid grid-cols-8 grid-rows-1 font-bold">
            <div class="cols-1"></div>
            <div class="cols-1">Monday</div>
            <div class="cols-1">Tuesday</div>
            <div class="cols-1">Wednesday</div>
            <div class="cols-1">Thursday</div>
            <div class="cols-1">Friday</div>
            <div class="cols-1">Saturday</div>
            <div class="cols-1">Sunday</div>
        </div>
        <div class="grid grid-cols-8 grid-rows-1">
            <div class="cols-1 font-bold">Open</div>
            <div class="cols-1">{{ (!empty($row->monday_open)) ? Carbon::parse($row->monday_open)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->tuesday_open)) ? Carbon::parse($row->tuesday_open)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->wednesday_open)) ? Carbon::parse($row->wednesday_open)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->thursday_open)) ? Carbon::parse($row->thursday_open)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->friday_open)) ? Carbon::parse($row->friday_open)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->saturday_open)) ? Carbon::parse($row->saturday_open)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->sunday_open)) ? Carbon::parse($row->sunday_open)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
        </div>
        <div class="grid grid-cols-8 grid-rows-1">
            <div class="cols-1 font-bold">Close</div>
            <div class="cols-1">{{ (!empty($row->monday_close)) ? Carbon::parse($row->monday_close)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->tuesday_close)) ? Carbon::parse($row->tuesday_close)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->wednesday_close)) ? Carbon::parse($row->wednesday_close)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->thursday_close)) ? Carbon::parse($row->thursday_close)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->friday_close)) ? Carbon::parse($row->friday_close)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->saturday_close)) ? Carbon::parse($row->saturday_close)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
            <div class="cols-1">{{ (!empty($row->sunday_close)) ? Carbon::parse($row->sunday_close)->timezone(auth()->user()->userProfile->timezone)->format('g:i A') : 'Closed' }}</div>
        </div>
    </div>
</div>
