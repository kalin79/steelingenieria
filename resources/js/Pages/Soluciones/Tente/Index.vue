<template>
    <AppLayout>
        <Hero :slides="banners" />
        <MasterComponent />
        <SolucionesComponent />
        <AreasComponent />
        <CaracteristicasComponent />
        <!-- <SeparateComponent /> -->
        <ContactoComponent />
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Components/Hero.vue";
import ContactoComponent from "@/Components/Share/ContactoTente.vue";
import MasterComponent from "@/Components/Share/Tente.vue";
// import SeparateComponent from "@/Components/Share/Separate.vue";
import SolucionesComponent from "@/Components/Tente/Soluciones.vue";
import AreasComponent from "@/Components/Tente/Areas.vue";
import CaracteristicasComponent from "@/Components/Tente/Caracteristicas.vue";
const banners = [
    {
        id: 1,
        image: "/images/tente.png",
        imageM: "/images/tenteM.png",
        title: "Soluciones de movilidad <br />con TENTE®",
        subtitle: "Impulsamos soluciones de movilidad",
        description: ``,
        boton: ``,
        link: ``,
    },
];
</script>