<div id="success-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Empleado agregado con éxito.</p>
    </div>
</div>
<style>
    /* Estilos CSS para la ventana modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        text-align: center;
    }
    .close {
        position: absolute;
        right: 20px;
        top: 10px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
</style>
<script>
    // JavaScript para mostrar la ventana modal
    var modal = document.getElementById('success-modal');
    var closeButton = document.querySelector('.close');

    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });
</script>
