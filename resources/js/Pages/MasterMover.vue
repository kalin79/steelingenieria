<template>
    <AppLayout>
        <Hero :slides="banners" />
        <MasterComponent />
        <ArrastradoresComponent />
        <SolucionesComponent />
        <VentajasComponent />
        <SeparateComponent />
        <ContactoComponent />
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Components/Hero.vue";
import ContactoComponent from "@/Components/Share/Contacto.vue";
import MasterComponent from "@/Components/Share/Master.vue";
import SeparateComponent from "@/Components/Share/Separate.vue";
import ArrastradoresComponent from "@/Components/MasterMover/Arrastradores.vue";
import SolucionesComponent from "@/Components/MasterMover/Soluciones.vue";
import VentajasComponent from "@/Components/MasterMover/Ventajas.vue";
const banners = [
    {
        id: 1,
        image: "/images/master.webp",
        imageM: "/images/master.webp",
        title: "Soluciones de remolque <br />con MasterMover",
        subtitle: "Mueve cargas pesadas de forma fácil",
        description: `Diseño, fabricación y montaje de proyectos industriales para <br />los sectores minero, logístico, manufacturero y alimentario.`,
        boton: `MÁS INFORMACIÓN`,
        link: `/contacto`,
    },
];
</script>
