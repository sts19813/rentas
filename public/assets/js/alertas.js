function showToast(icon, message, position = "top-end", timer = 3000) {
    Swal.fire({
        icon: icon,
        title: message,
        position: position,
        toast: true,
        showConfirmButton: false,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
}
