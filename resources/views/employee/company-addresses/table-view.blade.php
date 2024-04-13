
<address class="m-3">
    {{ $row->building_number }}
    @if(!empty($row->pre_direction))
        {{ $row->pre_direction }}
    @endif
    {{ $row->street_name }}
    {{ $row->street_type }}
    @if(!empty($row->post_direction))
        {{ $row->post_direction }}
    @endif
    @if(!empty($row->unit_type))
        <br />
        {{ $row->unit_type }}
        {{ $row->unit }}
    @endif
    <br />
    {{ $row->city }},
    {{ $row->state }}
    {{ $row->zip }}
</address>
