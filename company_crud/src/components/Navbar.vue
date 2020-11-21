<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link"  tag="a" to="/add-company">Şirket Ekle</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" tag="a" to="/company-update-delete">Şirket Düzen-Sil</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" tag="a" to="/personel-add">Çalışan Ekle</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" tag="a" to="/personel-update-delete">Çalışan Düzenle Sil</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>




<script>
    export default {
        name: "Navbar"
    }
</script>

<style scoped>

</style>
