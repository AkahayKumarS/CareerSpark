document.addEventListener('DOMContentLoaded', () => {
    let currentResumeId = null;
    let currentTemplateId = 1;
    let resumeData = {
        personal_info: {},
        education: [],
        experience: [],
        skills: [],
        color_scheme: '#2bc5d4',
        font_family: 'Roboto'
    };

    init();

    function init() {
        bindUIEvents();
        loadTemplates();
        if (typeof userId !== 'undefined') loadUserResume();
        loadSavedResume();
        loadStudentProfile();
        initLocalStorage();
    }

    function bindUIEvents() {
        // Navigation buttons
        document.querySelectorAll('.nav-link[data-section]').forEach(btn =>
            btn.addEventListener('click', () => showSection(btn.dataset.section))
        );

        // Inputs auto-save and preview
        document.querySelectorAll('input, textarea, select').forEach(input =>
            input.addEventListener('input', debounce(() => {
                updateFormData(input);
                updateResumePreview();
            }, 300))
        );

        // Font selector
        document.getElementById('font-family')?.addEventListener('change', e => {
            document.getElementById('resume-preview').style.fontFamily = e.target.value;
            resumeData.font_family = e.target.value;
        });

        // Color selector
        document.getElementById('custom-color')?.addEventListener('input', e => setTheme(e.target.value));

        // Section toggle switches
        document.querySelectorAll('.form-check-input').forEach(toggle =>
            toggle.addEventListener('change', updateResumePreview)
        );

        // Template selection
        document.querySelectorAll('.template-item').forEach(item =>
            item.addEventListener('click', function () {
                document.querySelectorAll('.template-item').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                currentTemplateId = this.dataset.templateId;
                updateResumePreview();
                saveResume();
            })
        );

        // Download resume
        document.getElementById('download-resume')?.addEventListener('click', () => {
            updateResumeStyles();
            window.print();
        });
    }

    function showSection(sectionName) {
        document.querySelectorAll('.section').forEach(s => s.style.display = 'none');
        document.getElementById(`${sectionName}-section`)?.style.display = 'block';
        updateNavigation(sectionName);
    }

    function updateNavigation(active) {
        document.querySelectorAll('.nav-link[data-section]').forEach(link => {
            link.classList.toggle('active', link.dataset.section === active);
        });
    }

    function validateSection(section) {
        let valid = true;
        document.querySelectorAll(`#${section}-section input[required]`).forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                valid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });
        return valid;
    }

    function nextSection(current, next) {
        if (validateSection(current)) showSection(next);
    }

    function prevSection(current, prev) {
        showSection(prev);
    }

    function debounce(func, delay) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func(...args), delay);
        };
    }

    function updateFormData(input) {
        const section = input.closest('.section')?.id.replace('-section', '');
        if (!section) return;

        resumeData[`${section}_info`] = resumeData[`${section}_info`] || {};
        resumeData[`${section}_info`][input.name || input.id] = input.value;

        localStorage.setItem('resumeData', JSON.stringify(resumeData));
    }

    async function loadTemplates() {
        try {
            const res = await fetch('../backend/get_templates.php');
            const templates = await res.json();
            const container = document.querySelector('.template-grid');
            container.innerHTML = templates.map(t => `
                <div class="template-item" data-template-id="${t.template_id}">
                    <img src="${t.template_thumbnail}" alt="${t.template_name}">
                    <span>${t.template_name}</span>
                </div>
            `).join('');
        } catch (e) {
            console.error('Failed to load templates', e);
        }
    }

    async function loadUserResume() {
        try {
            const res = await fetch(`../backend/get_resume.php?user_id=${userId}`);
            const resume = await res.json();
            if (resume) {
                currentResumeId = resume.resume_id;
                currentTemplateId = resume.template_id;
                resumeData = resume;
                populateFormFields();
                updateResumePreview();
            }
        } catch (e) {
            console.error('Failed to load resume', e);
        }
    }

    async function loadSavedResume() {
        try {
            const res = await fetch('../backend/get_resume.php');
            const data = await res.json();
            if (data?.success) {
                resumeData = data.resume;
                populateFormFields();
                updateResumePreview();
            }
        } catch (e) {
            console.error('Failed to load saved resume', e);
        }
    }

    async function loadStudentProfile() {
        try {
            const res = await fetch('../backend/get_profile.php');
            const profile = await res.json();
            if (profile) {
                document.getElementById('fullName').value = profile.name || '';
                document.getElementById('email').value = profile.email || '';
                document.getElementById('summary').value = profile.bio || '';
            }
        } catch (e) {
            console.error('Failed to load student profile', e);
        }
    }

    function populateFormFields() {
        for (const section in resumeData) {
            if (section.endsWith('_info')) {
                const fields = resumeData[section];
                Object.entries(fields).forEach(([key, value]) => {
                    const input = document.getElementById(key);
                    if (input) input.value = value;
                });
            }
        }
    }

    function updateResumePreview() {
        fetch('get_template.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                template_id: currentTemplateId,
                data: resumeData
            })
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('resume-preview').innerHTML = html;
        })
        .catch(err => console.error('Error updating preview:', err));
    }

    function updateResumeStyles() {
        const preview = document.getElementById('resume-preview');
        const color = document.getElementById('custom-color').value;
        const font = document.getElementById('font-family').value;

        preview.style.fontFamily = font;
        document.documentElement.style.setProperty('--primary', color);

        ['education', 'experience', 'skills'].forEach(section => {
            const el = preview.querySelector(`.${section}-section`);
            const toggle = document.getElementById(`show-${section}`);
            if (el && toggle) {
                el.style.display = toggle.checked ? 'block' : 'none';
            }
        });
    }

    async function saveResume() {
        try {
            const res = await fetch('../backend/save_resume.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    resume_name: 'My Resume',
                    template_id: currentTemplateId,
                    ...resumeData
                })
            });

            const result = await res.json();
            if (result.success) showToast('Resume saved!');
            else showToast('Error saving resume', 'error');
        } catch (err) {
            showToast('Failed to save', 'error');
        }
    }

    function showToast(message, type = 'success') {
        alert(`[${type.toUpperCase()}] ${message}`);
    }

    function setTheme(color) {
        resumeData.color_scheme = color;
        document.documentElement.style.setProperty('--primary', color);
        updateResumePreview();
    }

    function initLocalStorage() {
        if (!localStorage.getItem('resumeData')) {
            localStorage.setItem('resumeData', JSON.stringify(resumeData));
        }
    }

    // Helper Buttons (optional use)
    window.nextSection = nextSection;
    window.prevSection = prevSection;
});
