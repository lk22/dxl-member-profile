
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
            updatingCooperationEventForm: jQuery('update-cooperation-event-form'),
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

                console.log(MemberProfileEvent.profile)
                
                if (e.currentTarget.dataset.type == "training") {
                    cooperationEventForm.slideUp()
                    trainingEventForm.slideDown()
                }

                if ( e.currentTarget.dataset.type == "tournament" ) {
                    if ( MemberProfileEvent.profile.is_tournament_author ) {
                        // TODO: only show tournament event form here and hide other evet type forms
                    }
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
                serializedEventValues = trainingEventForm.serializeArray()
            } else if ( e.currentTarget.dataset.type == "cooperation" ) {
                serializedEventValues = cooperationEventForm.serializeArray();
            }

            serializedEventValues.forEach(function(field) {
                ProfileEvent.forms.values[field.name] = field.value
                if ( field.value == "" ) {
                    ProfileEvent.forms.validated = false;
                    jQuery('input[name="' + field.name + '"]').addClass('is-invalid');
                    return false;
                }

                ProfileEvent.forms.validated = true;
            })
            if (ProfileEvent.forms.validated) {
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
                    },
                    beforeSend: function() {
                        console.log("Sending request")
                    },
                    error: function(error) {
                        console.log(error);
    
                        new Swal({
                            title: "Ooops..",
                            text: "Der skete en uventet fejl, prøv igen senere",
                            icon: "error",
                            confirmButtonText: "Luk",
                        })
                    }
                })
            }
        })
    }, 

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
                    ProfileEvent.deleteEventAjax(e.currentTarget.dataset.event, e.currentTarget.dataset.type)
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
            const values = getFormValues(ProfileEvent.forms.updatingCooperationEventForm)
            values.action = actions.editEvent;
            values.nonce = DxlMemberProfile.nonce
            values.ajaxurl = DxlMemberProfile.ajaxurl
            values.type = type
            console.log(values)
            useAjaxRequest(
                DxlMemberProfile.ajaxurl,
                "POST",
                values,
                ProfileEvent.EventSuccessCallback(),
                () => {
                    ProfileEvent.buttons.updateEventButton.html("Opdaterer...")
                },
                (error) => {
                    console.log(error)
                    ProfileEvent.buttons.updateEventButton.html("Opdater")
                }
            )
        })
    },

    /**
     * Binding training event update handler
     */
    bindUpdateTrainingEvent: function() {
        const type = "training"
        ProfileEvent.buttons.updateTrainingEventButton.on('click', function(e) {
            e.preventDefault();
            const values = getFormValues(ProfileEvent.forms.updateTrainingEventForm)
            values.action = actions.editEvent
            values.nonce = DxlMemberProfile.nonce
            values.type = type

            useAjaxRequest(DxlMemberProfile, 'POST', values, (response) => {
                const parsed = JSON.parse(response)
                if (parsed.status == "success") window.location.reload()
                if (parsed.status == "error") console.log(parsed)
                ProfileEvent.buttons.updateTrainingEventButton.html("Opdater")
                ProfileEvent.buttons.editTrainingEventModal.modal('hide')
            }, () => {
                console.log("Updating event...")
                ProfileEvent.buttons.updateTrainingEventButton.html("Opdaterer...")
            }, (error) => {
                console.log(error)
                ProfileEvent.buttons.updateTrainingEventButton.html("Opdater")
            })
        })
    },

    bindPublishUnpublishEvent: () => {
        ProfileEvent.buttons.publishUnpublishButton.on('click', (e) => {
            const eventId = e.currentTarget.dataset.event
            const type = e.currentTarget.dataset.eventType
            const eventAction = e.currentTarget.dataset.action

            useAjaxRequest(DxlMemberProfile.ajaxurl, "POST", {
                action: actions.publishUnpublishEvent,
                nonce: DxlMemberProfile.nonce,
                event_id: eventId,
                event_type: type,
                event_action: eventAction
            }, (response) => {
                const parsed = JSON.parse(response)

                if (parsed.status == "success") window.location.reload()
                if (parsed.status == "error") console.log(parsed)

                eventAction == "publish" 
                    ? ProfileEvent.buttons.publishUnpublishButton.html("Offentliggør")
                    : ProfileEvent.buttons.publishUnpublishButton.html("Skjul")
            }, () => {
                eventAction == "publish" 
                    ? ProfileEvent.buttons.publishUnpublishButton.html("Offentliggør")
                    : ProfileEvent.buttons.publishUnpublishButton.html("Skjul")
            }, (error) => {
                console.log(error)
            })
        })
    },

    /**
     * Event ajax helper
     */
    deleteEventAjax: function(event, type) {
        jQuery.ajax({
            method: "POST",
            url: MemberProfileEvent.ajaxurl,
            data: {
                action: ProfileEvent.actions.deleteEvent,
                nonce: MemberProfileEvent.nonce,
                event_id: event,
                event_type: type
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
}

ProfileEvent.init();