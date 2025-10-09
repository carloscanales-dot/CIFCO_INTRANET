<template>
  <div class="d-flex justify-start relative">
    <!-- Avatar con imagen -->
    <v-avatar
      size="150"
      class="profile-avatar"
      @click="triggerFileInput"
    >
       <v-img 
        :src="profilePicture" 
        cover
        class="object-top" 
      ></v-img>
      <!-- Overlay con ícono "+" -->
      <div class="overlay">
        <v-icon size="40" color="white">mdi-plus</v-icon>
      </div>
    </v-avatar>

    <!-- Input oculto para subir imagen -->
    <input
      ref="fileInput"
      type="file"
      accept="image/*"
      class="d-none"
      @change="onFileChange"
    />
  </div>
</template>

<script setup>
import { ref } from "vue";

const profilePicture = ref("/pictures/carlos_canales.JPG"); // tu imagen por defecto
const fileInput = ref(null);

const triggerFileInput = () => {
  fileInput.value.click();
};

const onFileChange = (event) => {
  const file = event.target.files[0];
  if (file && file.type.startsWith("image/")) {
    profilePicture.value = URL.createObjectURL(file);
  }
};
</script>

<style scoped>
.profile-avatar {
  cursor: pointer;
  border:none; /* 👈 borde negro */
  transition: transform 0.2s ease-in-out;
  position: relative;
  overflow: hidden;
}
.profile-avatar:hover {
  transform: scale(1.05);
}

/* Overlay transparente con el ícono "+" */
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4); /* fondo oscuro transparente */
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  transition: opacity 0.2s ease-in-out;
}
.profile-avatar:hover .overlay {
  opacity: 1;
}
.objetct-top{
  object-position: top;
  object-fit: cover;
  height: 100%;
  width: 100%;
}
</style>
