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