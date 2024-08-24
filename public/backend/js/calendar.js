document.addEventListener('DOMContentLoaded', () => {
    window.calendar = new Calendar({
        target: document.getElementById('app'),
        props: {
            plugins: [TimeGrid, DayGrid, ResourceTimeGrid, ResourceTimeline, List],
            options: {
                view: 'dayGridMonth',
                eventSources: eventSources,
                resources: resources,
                height: '725px',
                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek resourceTimeGridWeek,resourceTimelineWeek'
                },
                eventClick: function(info) {
                    let extendedProps = info.event.extendedProps;
                    let titleHtml = info.event.extendedProps.technician_name;
                    let address = info.event.extendedProps.address;
                    let city = info.event.extendedProps.city;
                    let state = info.event.extendedProps.state;
                    let post_code = info.event.extendedProps.post_code;
                    let job_description = info.event.extendedProps.job_description;
                    let startTime = new Date(info.event.start).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    let endTime = new Date(info.event.end).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    let modalContent = `
                        <div class="container">
                            <div class="row">
                              <div class="col-6">
                               <dl>
                                <dt>Lead:</dt>
                                <dd>${titleHtml}</dd>
                                <dt>Technician:</dt>
                                <dd>${extendedProps.technician_name}</dd>
                                <dt>Address:</dt>
                                <dd>${address}</dd>
                                <dt>State:</dt>
                                <dd>${state}</dd>
                                </dl>
                            </div>
                            <div class="col-6">
                             <dl>
                                <dt>Time:</dt>
                                <dd>${startTime} - ${endTime}</dd>
                                <dt>Job Description:</dt>
                                <dd>${job_description}</dd>
                                <dt>City:</dt>
                                <dd>${city}</dd>
                                <dt>Post Code:</dt>
                                <dd>${post_code}</dd>
                             </dl>
                            </div>
                        </div>
                    </div>`;

                    document.getElementById('eventModalBody').innerHTML = modalContent;
                    new bootstrap.Modal(document.getElementById('eventModal')).show();
                },
                eventContent: function(arg) {
                    let titleHtml = arg.event.extendedProps.technician_name;
                    let startTime = new Date(arg.event.start).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    let endTime = new Date(arg.event.end).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    let techColor = arg.event.extendedProps.color;
                    return {
                        html: `
                            <div style="color:${techColor}">
                                <ul style="list-style-type:disc;padding-left:20px;font-size:12px">
                                    <li>${startTime} - ${endTime}<br>
                                    ${titleHtml}</li>
                                </ul>
                            </div>
                        `
                    };
                },
                eventDidMount: function(arg) {
                    arg.el.style.backgroundColor = 'transparent';
                }
            }
        }
    });
});
