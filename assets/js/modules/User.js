import Swal from 'sweetalert2'
import { actions } from './../contants'
import {
    getFormValues,
    useAjaxRequest
} from './../utilities'
import { useAlert } from '../utilities/dialog'

const ProfileUser = {
    init: function() {
        ProfileUser.buttons = {
            updateMemberButton: jQuery(".update-member-btn"),
        }
    
        ProfileUser.forms = {
            updateappForm: jQuery('.update_app_settings_form'),
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

            const values = getFormValues(ProfileUser.forms.updateappForm)
            values.action = actions.updateProfileInformation;
            values.nonce = DxlMemberProfile.nonce;

            useAjaxRequest(DxlMemberProfile.ajaxurl, "POST", values, (response) => {
                console.log(response)
                const parsed = JSON.parse(response)

                if (parsed.status == "error") {
                    useAlert("Der skete en fejl, prøv igen senere", () => {
                        console.log(parsed)
                    })
                } else {
                    useAlert("Dine oplysninger blev opdateret", () => {})
                }

                ProfileUser.buttons.updateMemberButton.attr('value', 'Gem')
            }, () => {
                useAlert("Opdatere dine Oplysninger", () => {
                    console.log("updating member resource");
                });
            }, (error) => {
                console.log(error)
            })
        })
    }
}

export default ProfileUser