const ProfileUser = {
    init: function() {
        ProfileUser.api = "/wp-json/api/v1/profile/user/";

        ProfileUser.actions = {
            updateProfileInformation: "dxl_profile_update_profile_information",
            requestTrainerPermissions: "dxl_request_trainer_permissions"        
        }

        ProfileUser.buttons = {
            updateMemberButton: jQuery(".update-member-btn"),
        }
    
        ProfileUser.forms = {
            updateappForm: jQuery('.update_app_settings_form'),
            memberForm: jQuery('.update_profile_settings_form'),
            values: {}
        }
        ProfileUser.bind()
    },

    bind: function() {
        ProfileUser.bindUpdateMember()
    },

    bindUpdateMember() {
        jQuery('.theme-color-switcher').each(function(i, theme) {
            jQuery(theme).on('click', function(e) {
                const colorTheme = jQuery(theme).data('theme')
                const color = jQuery(theme).data('theme-color')
                const body = jQuery('body')
                body.attr('data-theme', colorTheme)
                body.find('a').css({
                    "color": color
                })

                body.find('label').css({"color": color})
    
                body.find('.dxl-btn').css({
                    "background-color": color
                })
    
                jQuery('.member-theme-form').find('input[name="theme-color"]').val(color);
                jQuery('.member-theme-form').find('input[name="theme-name"]').val(colorTheme);
            })
        })
    
        jQuery('.member-theme-form').on('submit', function(e) {
            e.preventDefault();
            const theme = jQuery('.member-theme-form').find('input[name="theme-name"]').val();
            const themeColor = jQuery('.member-theme-form').find('input[name="theme-color"]').val();
    
            window.localStorage.setItem('theme', theme)
            window.localStorage.setItem('theme_color', themeColor)
    
            new Swal({
                title: "Tema Opdateret",
                text: "Dit farve tema er opdateret",
                icon: "success",
                confirmButtonText: "Luk"
            })
        })

        ProfileUser.buttons.updateMemberButton.on('click', function(e) {
            e.preventDefault()

            const fields = ProfileUser.forms.memberForm.serializeArray();

            fields.forEach((field) => {
                ProfileUser.forms.values[field.name] = field.value;
            });

            ProfileUser.forms.values.action = ProfileUser.actions.updateProfileInformation;
            ProfileUser.forms.values.nonce = MemberProfileUser.nonce;

            jQuery.ajax({
                url: MemberProfileUser.ajaxurl,
                method: "POST",
                data: ProfileUser.forms.values,
                beforeSend: function() {
                    new Swal({
                        title: "Opdaterer Oplysninger",
                        text: "Vi opdaterer dine oplysninger",
                        icon: "info",
                        confirmButtonText: "Luk"
                    })
                },
                success: function(response) {
                    console.log(response)

                    const parsed = JSON.parse(response)
                    if ( parsed.status == "erorr" ) {
                        new Swal({
                            title: "Der skete en fejl",
                            text: "Der skete en fejl, prøv igen senere",
                            icon: "error",
                            confirmButtonText: "Luk"
                        })
                    }

                    if ( parsed.status == "success" ) {
                        new Swal({
                            title: "Oplysninger Opdateret",
                            text: "Dine oplysninger blev opdateret",
                            icon: "success",
                            confirmButtonText: "Luk"
                        })
                    }

                    ProfileUser.buttons.updateMemberButton.attr('value', 'Gem')
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })
    }
}

ProfileUser.init();