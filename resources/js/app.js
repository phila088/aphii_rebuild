import '../libs/custom/custom';
import './bootstrap';
import { HSTabs } from 'preline';
import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
import './../../vendor/power-components/livewire-powergrid/dist/tailwind.css'
import flatpickr from "flatpickr";
import toastr from "toastr";
import mask from '@alpinejs/mask';

Alpine.plugin(mask);

window.HSTabs = HSTabs;

if (document.readyState === 'complete') {
    window.HSStaticMethods.autoInit();
    window.HSTabs.autoInit();
}
