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
                    let titleHtml = extendedProps.title;
                    let assigned_to =  extendedProps.assigned_to;
                    let priority = extendedProps.priority;
                    let related_job = extendedProps.related_job;
                    let description = extendedProps.description;
                    let status = extendedProps.status;
                    

                    let modalContent = `
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                <dl>
                                    <dt>Task:</dt>
                                    <dd>${titleHtml}</dd>
                                    <dt>Assigned To:</dt>
                                    <dd>${assigned_to}</dd>
                                    <dt>Priority:</dt>
                                    <dd>${priority}</dd>
                                    
                                    </dl>
                                </div>
                                <div class="col-6">
                                <dl>
                                    <dt>Related Job:</dt>
                                    <dd>${related_job}</dd>
                                    <dt>Status:</dt>
                                    <dd>${status}</dd>
                                </dl>
                                </div>
                            </div>
                            <div class="row">
                              
                                <div class="col-12">
                                <dl>
                                    <dt>Description:</dt>
                                    <dd>${description}</dd>
                                </dl>
                                </div>
                            </div>
                    </div>`;

                    document.getElementById('eventModalBody').innerHTML = modalContent;
                    new bootstrap.Modal(document.getElementById('eventModal')).show();
                },
                eventContent: function(arg) {

                    let titleHtml = arg.event.extendedProps.title;
                    let assigned_to =  arg.event.extendedProps.assigned_to;
                    let priority =  arg.event.extendedProps.priority;
                    let color = "#000";
                    if(priority=="High")
                    {
                        color = "#bb2124";
                    }
                    if(priority=="Medium")
                    {
                        color = "#f0ad4e";
                    }
                    if(priority=="Low")
                    {
                        color = "#22bb33";
                    }


                    return {
                        html: `
                            <div style="color:${color}">
                                <ul style="list-style-type:disc;padding-left:20px;font-size:12px">
                                    <li> ${titleHtml}<br>
                                    Assigned To: <span> ${assigned_to}</span></li>
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
