define(['jquery', 'core/log', 'core/fragment', 'core/templates', 'core/ajax'], function($, log, fragment, templates, ajax) {

    return {
        init: function(courseid, contextid) {

            $(document).ready(function() {

                const defaultValue = $('[name="email"]').val();

                const border = () => {
                    $("input[name='email']").css({
                    'border-color': 'red'
                   });
                }

                $('#id_add').click((event) => {
                    event.preventDefault();
                    event.stopPropagation();

                    const email = $("input[name='email']").val().trim();
                    const validate = (email) => {
                        const expression = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                        return expression.test(String(email).toLowerCase()) && String(email).length;
                    }
                    if (!validate(email)) {
                        border();
                        alert('Invalid email');
                        return;
                    }

                    const params = {
                        courseid: courseid,
                        email: email
                    };

                    var promise = ajax.call([{
                        methodname: 'block_zoomwebinarhost_create_webinar_host',
                        args: {
                            courseid: courseid,
                            email: email
                        }
                    }]);

                    promise[0].then((response) => {
                        fragment.loadFragment('block_zoomwebinarhost', 'formreload', contextid, params).done(function(html, js) {
                            M.core_formchangechecker.reset_form_dirty_state();
                            templates.replaceNodeContents($('.mform'), html, js);
                            document.location.reload();
                        })
                    }).catch((error) => {
                        border();
                        alert(error.message);
                        console.log(error.message);
                        return;
                    })
                });

                $('[id*="id_delete"]').click((e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    const host = e.target.id;
                    const hostid = host.split(/\_(?=[^\_]+$)/)[1];

                    const email_to_delete = $('#fitem_id_host_' + hostid)[0].innerText.trim();
                    const params = {
                        courseid: courseid,
                        email: email_to_delete
                    };


                    var promise1 = ajax.call([{
                        methodname: 'block_zoomwebinarhost_delete_webinar_host',
                        args: {
                            courseid: courseid,
                            email: email_to_delete
                        }
                    }]);

                    promise1[0].then((response) => {
                        fragment.loadFragment('block_zoomwebinarhost', 'formreload', contextid, params).then(function(html, js) {
                            templates.replaceNodeContents($('.mform'), html, js)
                        });
                        document.location.reload();
                    }).catch((error) => {
                        console.log(error);
                    })
                });

                $('#id_email').focus((e) => {
                    $(e.target).val('').css({
                        'border-color': ''
                    });
                });

            });
        }
    };
});