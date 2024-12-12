window.onload = () => {
    setTimeout(() => {
        if (document.getElementById('alert') != null) {
            document.getElementById('alert').remove()
        }
    }, 3000);
}