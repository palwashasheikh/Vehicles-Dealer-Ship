import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import './BaseModalController.js';

import './DatatableControllers/Datatable.js';
;




import Calendar from '@event-calendar/core';
import TimeGrid from '@event-calendar/time-grid';
import DayGrid from '@event-calendar/day-grid';
import ResourceTimeGrid from '@event-calendar/resource-time-grid';
import ResourceTimeline from '@event-calendar/resource-timeline';
import List from '@event-calendar/list';
import '@event-calendar/core/index.css';

window.Calendar = Calendar;
window.TimeGrid = TimeGrid;
window.DayGrid = DayGrid;
window.ResourceTimeGrid = ResourceTimeGrid;
window.ResourceTimeline = ResourceTimeline;
window.List = List;
