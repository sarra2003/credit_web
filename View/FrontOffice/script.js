function validateQuestionForm(campagneId) {
                        var input = document.getElementById('question-text-' + campagneId);
                        if (!input.value.trim()) {
                            alert('Please enter a question.');
                            input.focus();
                            return false;
                        }
                        // Add more validation if needed
                        return true;
                    }

                    function openEditPopup(campagneId) {
                        var popup = document.getElementById('edit-popup-' + campagneId);
                        if (popup) {
                            popup.style.display = 'block';
                        }
                    }
                    function closeEditPopup(campagneId) {
                        var popup = document.getElementById('edit-popup-' + campagneId);
                        if (popup) {
                            popup.style.display = 'none';
                        }
                    }
        
function openModifierPopup(btn, reponseId, reponseTexte, questionId, userId) {
                                                    var popup = btn.parentNode.querySelector('.modifier-popup');
                                                    if (popup) {
                                                        popup.style.display = 'flex';
                                                        var form = popup.querySelector('form');
                                                        form.reponse_id.value = reponseId;
                                                        form.nouvelle_reponse.value = reponseTexte;
                                                        form.question_id.value = questionId;
                                                        form.user_id.value = userId;
                                                    }
                                                }
                                                function closeModifierPopup(closeBtn) {
                                                    var popup = closeBtn.closest('.modifier-popup');
                                                    if (popup) popup.style.display = 'none';
                                                }
                                                function validateModifierForm(form) {
                                                    var input = form.querySelector('input[name="nouvelle_reponse"]');
                                                    if (!input.value.trim()) {
                                                        alert('Veuillez entrer une réponse.');
                                                        input.focus();
                                                        return false;
                                                    }
                                                    return true;
                                                }