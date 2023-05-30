
const ProfileEvent = {
    init: () => {
        ProfileEvent.modals = {
            createEventModal: jQuery('#createEventModal'),
            editEventModal: jQuery('edit-event-modal'),
            editTrainingEventModal: jQuery('#trainingEventUpdateModal'),
            deleteEventModal: jQuery('#delete-event-modal'),
            publishEventModal: jQuery('#publish-event-modal'),
            unpublishEventModal: jQuery('#unpublish-event-modal')
        }

        ProfileEvent.buttons = {
            createEventButton: jQuery(".create-event-btn"),
            updateEventButton: jQuery(".update-event-btn"),
            updateTrainingEventButton: jQuery(".update-training-event-btn"),
            deleteEventButton: jQuery(".delete-event-button"),
            publishUnpublishButton: jQuery(".publish-unpublish-event-btn"),
            unpublishEventButton: jQuery(".unpublish-event-button"),
        }

        ProfileEvent.forms = {
            createEventForm: jQuery('.create-event-modal-form'),
            createTrainingEventForm: jQuery('.create-training-event-form'),
            updatingCooperationEventForm: jQuery('.update-cooperation-event-form'),
            updateTrainingEventForm: jQuery('.update-training-event-form'),
            values: {},
            validated: false
        }

        ProfileEvent.actions = {
            createEvent: "dxl_profile_create_event",
            editEvent: "dxl_profile_edit_event",
            deleteEvent: "dxl_profile_delete_event",
            publishUnpublishEvent: "dxl_profile_publish_unpublish_event",
        }

        ProfileEvent.bind();
    },

    /**
     * Bind sub event triggers
     */
    bind: function() {
        ProfileEvent.bindCreateEvent()
        ProfileEvent.bindDeleteEvent()
        ProfileEvent.bindUpdateCooperationEvent()
        ProfileEvent.bindUpdateTrainingEvent()
        ProfileEvent.bindPublishUnpublishEvent()
    },

    /**
     * Bind create event handler
     * @return void
     */
    bindCreateEvent: function() {
        const eventType = jQuery(".event-type-selector").find('.type-selector');
        const trainingEventForm = jQuery(".create-training-event-content");
        const cooperationEventForm = jQuery(".create-cooperation-event-form");

        eventType.each(function(index, selector) {
            jQuery(selector).on('click', function(e) {
                jQuery(this).addClass('active').siblings().removeClass('active');
                
                if (e.currentTarget.dataset.type == "training") {
                        cooperationEventForm.slideUp()
                        trainingEventForm.slideDown()
                }

                if (e.currentTarget.dataset.type == "cooperation") {
                    trainingEventForm.slideUp()
                    cooperationEventForm.slideDown()
                }

                jQuery('.create-event-btn').attr('data-type', e.currentTarget.dataset.type)
                jQuery('#createEventModal').find('.modal-footer').show();
            })
        })

        jQuery('.create-event-btn').on('click', function(e) {
            let serializedEventValues;
            
            if ( e.currentTarget.dataset.type == "training" ) {
                serializedEventValues = ProfileEvent.forms.createTrainingEventForm.serializeArray()
            } else if ( e.currentTarget.dataset.type == "cooperation" ) {
                serializedEventValues = cooperationEventForm.serializeArray();
            }

            console.log(e.currentTarget.dataset.type)

            serializedEventValues.forEach(function(field) {
                ProfileEvent.forms.values[field.name] = field.value
                if ( field.value == "" ) {
                    ProfileEvent.forms.validated = false;
                    jQuery('input[name="' + field.name + '"]').addClass('is-invalid');
                    return false;
                }

                ProfileEvent.forms.validated = true;
            })

            console.log(ProfileEvent.forms.values);

            if (ProfileEvent.forms.validated) {
                console.log("test")
                jQuery.ajax({
                    method: "POST",
                    url: MemberProfileEvent.ajaxurl,
                    data: {
                        action: ProfileEvent.actions.createEvent,
                        nonce: MemberProfileEvent.nonce,
                        values: ProfileEvent.forms.values,
                        member_id: MemberProfileEvent.member.user_id,
                        event_type: e.currentTarget.dataset.type
                    },
                    success: function(response) {
                        console.log(response);
    
                        const parsed = JSON.parse(response)
                        if (parsed.status == "success") window.location.reload()
                        if (parsed.status == "error") console.log(parsed)
                        jQuery('.create-event-btn').html('<i class="fa-solid fa-spinner"></i>');
                    },
                    beforeSend: function() {
                        console.log("Sending request")
                        jQuery('.create-event-btn').html('<i class="fa-solid fa-spinner"></i>');
                    },
                    error: function(error) {
                        console.log(error);
    
                        new Swal({
                            title: "Ooops..",
                            text: "Der skete en uventet fejl, prøv igen senere",
                            icon: "error",
                            confirmButtonText: "Luk",
                        })
                        jQuery('.create-event-btn').html('<i class="fa-solid fa-spinner"></i>');
                    }
                })
            }
        })
    }, 

    /**
     * Binding delete event handler
     */
    bindDeleteEvent: () => {
        ProfileEvent.buttons.deleteEventButton.on('click', (e) => {

            new Swal({
                title: "Sletter begivenhed...",
                text: "Vent venligst mens begivenheden bliver slettet...",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ja, slet begivenhed",
                cancelButtonText: "Nej, behold begivenhed",
                showLoaderOnConfirm: true,
            }).then((result) => {
                if(result.value) {
                    ProfileEvent.deleteEventAjax(
                        ProfileEvent.actions.deleteEvent,
                        MemberProfileEvent.nonce,
                        e.currentTarget.dataset.event,
                        e.currentTarget.dataset.type
                    )
                }
            })
        })
    },

    /**
     * Bind update cooperation event handler
     */
    bindUpdateCooperationEvent: () => {
        const type = "cooperation"
        ProfileEvent.buttons.updateEventButton.on('click', (e) => {
            e.preventDefault();

            ProfileEvent.forms.updatingCooperationEventForm.serializeArray().forEach(function(field) {
                ProfileEvent.forms.values[field.name] = field.value;
            })
            console.log(ProfileEvent.forms.values);
            
            ProfileEvent.forms.values["action"] = ProfileEvent.actions.editEvent
            ProfileEvent.forms.values["nonce"] = MemberProfileEvent.nonce
            ProfileEvent.forms.values["type"] = type
            
            console.log(ProfileEvent.forms.values);

            ProfileEvent.ajaxUpdateEvent(ProfileEvent.forms.values);
        })
    },

    /**
     * Binding training event update handler
     */
    bindUpdateTrainingEvent: function() {
        const type = "training"
        ProfileEvent.buttons.updateTrainingEventButton.on('click', function(e) {
            e.preventDefault();

            ProfileEvent.forms.updateTrainingEventForm.serializeArray().forEach(function(field) {
                ProfileEvent.forms.values[field.name] = field.value;
            })

            ProfileEvent.forms.values["action"] = ProfileEvent.actions.editEvent;
            ProfileEvent.forms.values["nonce"] = MemberProfileEvent.nonce;
            ProfileEvent.forms.values["type"] = type;

            console.log(ProfileEvent.forms.values)

            ProfileEvent.ajaxUpdateEvent(ProfileEvent.forms.values);
        })
    },

    /**
     * Bind publish and unpublishing event handler
     * @return void
     */
    bindPublishUnpublishEvent: () => {
        ProfileEvent.buttons.publishUnpublishButton.on('click', (e) => {
            const eventId = e.currentTarget.dataset.event
            const type = e.currentTarget.dataset.eventType
            const eventAction = e.currentTarget.dataset.action

            const data = Object.assign({}, {
                event_id: eventId, 
                event_type: type, 
                event_action: eventAction, 
                action: ProfileEvent.actions.publishUnpublishEvent, 
                nonce: MemberProfileEvent.nonce 
            })

            ProfileEvent.ajaxPublishUnpublishEvent(data);
        })
    },

    /**
     * Event ajax helper
     */
    deleteEventAjax: function(action, nonce, event_id, event_type) {
        jQuery.ajax({
            method: "POST",
            url: MemberProfileEvent.ajaxurl,
            data: {
                action,
                nonce,
                event_id,
                event_type
            },
            beforeSend: function() {
                new Swal({
                    title: "Sletter begivenhed...",
                    text: "Vent venligst mens begivenheden bliver slettet...",
                    icon: "warning",
                    showCancelButton: false,
                })
            },
            success: function(response) {
                console.log(response) 
                const parsed = JSON.parse(response)

                if ( parsed.status == "success" ) {
                    new Swal({
                        title: "Begivenhed slettet!",
                        text: "Din begivenhed er nu slettet du vil blive dirigeret tilbage til din event liste",
                        icon: "success",
                        showConfirmButton: true,
                        confirmButtonText: "forstået"
                    }).then((result) => {
                        if ( result.value ) {
                            window.location.href = window.location.pathname + "/?module=events"
                        }
                    })
                }

                if ( parsed.stauts == "error" ) {
                    console.log(parsed);
                    new Swal({
                        title: "Ooops..",
                        text: "Noget gik galt, kunne ikke slette din begivenehd, prøv igen senere",
                        icon: "error",
                        confirmButtonText: "Luk"
                    })
                }
            },
            error: function(error) {
                console.log(error)
                new Swal({
                    title: "Ooops..",
                    text: "Der skete en uventet fejl, prøv igen senere",
                    icon: "error",
                    confirmButtonText: "Luk",
                })
            }
        })
    },

    /**
     * Update existing event
     * @param {*} event 
     */
    ajaxUpdateEvent: function( event ) {
        jQuery.ajax({ method: "POST", url: MemberProfileEvent.ajaxurl, data: event, success: function(response) {
            console.log(response);
        
            const json = JSON.parse(response)
        
            if (json.status == "success") {
                window.location.reload();
            }

            if ( json.status == "error" ) {
                console.log(json)
            }
        
            ProfileEvent.buttons.updateTrainingEventButton.html("Opdater")
            ProfileEvent.buttons.editTrainingEventModal.modal('hide');
        }, error: function(error) {
            console.log(error)
            
            new Swal({
                title: "Ooops..",
                text: "Noget gik galt, kunne ikke opdatere event",
                icon: "error",
                confirmButtonText: "Luk"
            })

            ProfileEvent.buttons.updateTrainingEventButton.html('Opdater')
        }, beforeSend() {
            new Swal({
                title: "Updating event...",
                text: "Opdatere event, vent venligst",
                icon: "info"
            });
        }})
    },

    /**
     * requesting publish or unpublish event 
     * @param int event_id 
     * @param string event_type 
     * @param string event_action 
     */
    ajaxPublishUnpublishEvent: function(data) {
        console.log(data)
        
        jQuery.ajax({ method: "POST", url: MemberProfileEvent.ajaxurl, data: data, beforeSend: function() {
            new Swal({
                title: (data.event_action == "publish") ? "Offentliggøre event" : "Sætter event i udkast tilstand",
                text: "Vent venligst",
                icon: "info",
                showConfirmButton: false,
                showCancelButton: false
            })
            }, success: function(response) {
                console.log(response);

                const parsed = JSON.parse(response)
                if ( parsed.status == "success" ) {
                    new Swal({
                        title: "Success",
                        text: "Begivenheden er opdateret.",
                        icon: "success",
                        showConfirmButton: true,
                        confirmButtonText: "luk",
                    }).then((result) => {
                        if ( result.value ) {
                            window.location.reload();
                        }
                    })
                } 

                if ( parsed.status == "failed" ) {
                    new Swal({ title: "Oops..", text: "Noget gik galt, kunne ikke opdatere eventet", icon: "error", confirmButtonText: "Luk" })
                }

            }, error: function(error) {
                console.log(error);
                new Swal({
                    title: "Oops..",
                    text: "Noget gik galt, kunne ikke opdatere eventet",
                    icon: "error"
                })
            }
        })
    }
}

/**
 * Serializing form fields
 * @param {*} form 
 * @returns 
 */
function serializeFormFields(form) {
    let formFields = {}
    form.serializeArray().forEach(function(field) {
        formFields[field.name] = field.value;
    })

    return formFields;
}

/**
 * custom debounce function
 * @param {*} callback 
 * @param {*} duration 
 * @returns 
 */
function _debounce(callback, duration) {
    let timer
    return (...args) => {
        clearTimeout(timer);
        time = setTimeout(() => {
            callback(...args)
        }, duration)
    }
}

/**
 * Throttle function
 * Throttle is another technique to minimize unnecessary function invocations when using event listeners.
 * However, throttle works a bit differently from debouncing. Instead of delaying, 
 * it invokes the callback function at regular intervals as long as the event trigger is active.
 * @param {*} callback 
 * @param {*} delay 
 * @returns 
 */
function _throttle(
    callback,
    delay = 1000
) {
    let shouldWait = false
    return (...args) => {
        if ( shouldWait ) return
        callback(...args);
        shouldWait = true
        setTimeout(() => {
            shouldWait = false;
        }, delay)
    }
}

ProfileEvent.init();