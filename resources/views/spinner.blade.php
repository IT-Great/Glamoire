<div class="loading-container" style="display: none;"> <!-- Initially hidden -->
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div class="loading-text">Mohon Tunggu ...</div>
</div>

<style>
    .loading-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.8); /* Light background */
        z-index: 9999; /* Ensure it overlays other content */
    }

    .spinner-border {
        width: 3rem;
        height: 3rem;
        margin-bottom: 20px;
    }

    .loading-text {
        font-size: 20px;
        color: #333;
    }
</style>
