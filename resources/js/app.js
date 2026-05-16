import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('[data-sidebar]');
    const backdrop = document.querySelector('[data-sidebar-backdrop]');
    const openButtons = document.querySelectorAll('[data-sidebar-toggle]');
    const closeButtons = document.querySelectorAll('[data-sidebar-close]');
    const passwordToggles = document.querySelectorAll('[data-password-toggle]');
    const modalOpens = document.querySelectorAll('[data-modal-open]');
    const modalCloses = document.querySelectorAll('[data-modal-close]');
    const modals = document.querySelectorAll('dialog[data-modal]');
    const alertDismissButtons = document.querySelectorAll('[data-alert-dismiss]');

    if (sidebar && backdrop) {
        const openSidebar = () => {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            backdrop.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        };

        const closeSidebar = () => {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            backdrop.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        };

        openButtons.forEach((button) => button.addEventListener('click', openSidebar));
        closeButtons.forEach((button) => button.addEventListener('click', closeSidebar));
        backdrop.addEventListener('click', closeSidebar);

        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });
    }

    const openModal = (id) => {
        const dialog = id ? document.getElementById(id) : null;

        if (!dialog) {
            return;
        }

        if (typeof dialog.showModal === 'function') {
            dialog.showModal();
            return;
        }

        dialog.setAttribute('open', '');
    };

    const closeModal = (dialog) => {
        if (!dialog) {
            return;
        }

        if (typeof dialog.close === 'function') {
            dialog.close();
            return;
        }

        dialog.removeAttribute('open');
    };

    modalOpens.forEach((button) => {
        button.addEventListener('click', () => {
            openModal(button.getAttribute('data-modal-open'));
        });
    });

    modalCloses.forEach((button) => {
        button.addEventListener('click', () => {
            closeModal(button.closest('dialog'));
        });
    });

    modals.forEach((dialog) => {
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) {
                closeModal(dialog);
            }
        });
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            modals.forEach((dialog) => {
                if (dialog.open) {
                    closeModal(dialog);
                }
            });
        }
    });

    alertDismissButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const alert = button.closest('[data-alert]');

            if (alert) {
                alert.remove();
            }
        });
    });

    passwordToggles.forEach((button) => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-password-toggle');
            const input = targetId ? document.getElementById(targetId) : null;

            if (!input) {
                return;
            }

            const isHidden = input.getAttribute('type') === 'password';
            input.setAttribute('type', isHidden ? 'text' : 'password');
            button.setAttribute('aria-pressed', String(isHidden));

            const showIcon = button.querySelector('[data-password-icon-show]');
            const hideIcon = button.querySelector('[data-password-icon-hide]');

            if (showIcon && hideIcon) {
                showIcon.classList.toggle('hidden', !isHidden);
                hideIcon.classList.toggle('hidden', isHidden);
            }
        });
    });
});
