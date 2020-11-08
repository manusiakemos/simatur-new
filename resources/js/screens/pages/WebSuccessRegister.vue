<template>
    <div class="d-flex align-items-center justify-content-center h100vh">
        <div class="center-content login-bg">
            <div class="text-white">
                <h1 class="display-1">Success</h1>
                <h4>Akun berhasil diverifikasi</h4>

                <div class="mt-4">
                    <b-btn :to="{name:'Login'}">Login Sekarang</b-btn>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WebSuccessRegister"
    }
</script>
