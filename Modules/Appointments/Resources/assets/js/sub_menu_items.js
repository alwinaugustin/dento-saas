import ConfirmDialog from 'primevue/confirmdialog';

export default function generateSubMenuItems(data) {
    return [
        {
            label: 'Cancel',
            icon: 'pi pi-ban',
            command: () => showConfirmationDialog('Cancel', () => {
                // Handle 'Cancel' logic
            })
        },
        {
            label: 'Add Bill',
            icon: 'pi pi-dollar',
            command: () => showConfirmationDialog('Add Bill', () => {
                // Handle 'Add Bill' logic
            })
        },
        {
            label: 'Mark Completed',
            icon: 'pi pi-lock',
            command: () => showConfirmationDialog('Mark Completed', () => {
                // Handle 'Mark Completed' logic
            })
        },
        {
            label: 'Reschedule',
            icon: 'pi pi-calendar-plus',
            command: () => showConfirmationDialog('Reschedule', () => {
                // Handle 'Reschedule' logic
            })
        },
        {
            label: 'Patient Details',
            icon: 'pi pi-eye',
            command: () => showConfirmationDialog('Patient Details', () => {
                // Handle 'Patient Details' logic
            })
        }
    ];

    function showConfirmationDialog(header, acceptCallback) {
        ConfirmDialog.create({
            message: 'Are you sure you want to proceed?',
            header: header,
            icon: 'pi pi-exclamation-triangle',
            accept: acceptCallback,
            reject: () => {
                // Callback to execute when the user rejects the action
            },
            onShow: () => {
                // Callback to execute when the dialog is shown
            },
            onHide: () => {
                // Callback to execute when the dialog is hidden
            }
        });
    }
}
