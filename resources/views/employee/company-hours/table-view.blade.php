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
            <div class="cols-1">{{ $row->monday_open }}</div>
            <div class="cols-1">{{ $row->tuesday_open }}</div>
            <div class="cols-1">{{ $row->wednesday_open }}</div>
            <div class="cols-1">{{ $row->thursday_open }}</div>
            <div class="cols-1">{{ $row->friday_open }}</div>
            <div class="cols-1">{{ $row->saturday_open }}</div>
            <div class="cols-1">{{ $row->sunday_open }}</div>
        </div>
        <div class="grid grid-cols-8 grid-rows-1">
            <div class="cols-1 font-bold">Close</div>
            <div class="cols-1">{{ $row->monday_close }}</div>
            <div class="cols-1">{{ $row->tuesday_close }}</div>
            <div class="cols-1">{{ $row->wednesday_close }}</div>
            <div class="cols-1">{{ $row->thursday_close }}</div>
            <div class="cols-1">{{ $row->friday_close }}</div>
            <div class="cols-1">{{ $row->saturday_close }}</div>
            <div class="cols-1">{{ $row->sunday_close }}</div>
        </div>
    </div>
</div>
