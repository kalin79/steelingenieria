<template>
    <AppLayout>
        <Hero :slides="banners" />
        <MasterComponent />
        <CaracteristicasComponent :caracteristicas="caracteristicas" />
        <LineasComponent :lineas="Lineas" />
        <GaleriaComponent :galerias="Galerias" />
        <SeparateComponent />
        <ContactoComponent />
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Components/HeroSecciones.vue";
import ContactoComponent from "@/Components/Share/Atencion.vue";
import MasterComponent from "@/Components/Share/Master.vue";
import SeparateComponent from "@/Components/Share/Separate.vue";
import CaracteristicasComponent from "@/Components/Share/MasterMover/Caracteristicas.vue";
import LineasComponent from "@/Components/Share/MasterMover/Lineas.vue";
import GaleriaComponent from "@/Components/Share/MasterMover/Galeria.vue";
const banners = [
    {
        id: 1,
        image: "/images/bs1.webp",
        imageM: "/images/bs1.webp",
        icono: "/images/kg.svg",
        kilos: `hasta 2,000 kg.`,
        title: "smartMover",
        subtitle: "",
        description: `Remolcadores eléctricos pequeños pero potentes para <br />eliminar la manipulación manual.`,
        boton: ``,
        link: ``,
    },
];

const caracteristicas = {
    subtitulo: `SmartMover`,
    titulo: `Más potencia, menos esfuerzo en el <br />movimiento de cargas`,
    descripcion: `Mueva hasta 2.000 kg con seguridad y mínimo esfuerzo gracias a los equipos eléctricos de arrastre SmartMover.`,
    items: [
        {
            icono: `/images/Sicon1.svg`,
            descripcion: `Baterías intercambiables para operación continua 24/7`,
        },
        {
            icono: `/images/Sicon2.svg`,
            descripcion: `Dos motores de alto rendimiento para máxima potencia`,
        },
        {
            icono: `/images/Sicon3.svg`,
            descripcion: `Diseño compacto para maniobrar en espacios estrechos`,
        },
        {
            icono: `/images/Sicon4.svg`,
            descripcion: `Elimina la manipulación manual de cargas`,
        },
        {
            icono: `/images/Sicon5.svg`,
            descripcion: `Transporte seguro de cargas de hasta 2 toneladas`,
        },
        {
            icono: `/images/Sicon6.svg`,
            descripcion: `Rendimiento confiable en interiores y exteriores`,
        },
        {
            icono: `/images/Sicon7.svg`,
            descripcion: `Máxima protección gracias a sus sistemas de seguridad`,
        },
        {
            icono: `/images/Sicon8.svg`,
            descripcion: `Conexiones hidráulicas seguras para una operación confiable`,
        },
    ],
};

const Lineas = {
    subtitulo: ``,
    titulo: `Explore la línea <br />SmartMover`,
    descripcion: `La gama SmartMover ofrece equipos eléctricos de arrastre que facilitan el movimiento seguro de cargas y optimizan las operaciones logísticas.`,
    productos: [
        {
            imagen: `/images/p1.png`,
            subtitulo: `SERIE SMARTMOVER`,
            titulo: `SM100 Tow`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `500 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `10°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `15.1 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `4.5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p2.png`,
            subtitulo: `SERIE SMARTMOVER`,
            titulo: `LM100`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `1000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `30°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `9.3 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `4.5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p3.png`,
            subtitulo: `SERIE SMARTMOVER`,
            titulo: `SM100+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `1200 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `50°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `7.7 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `4.5 horas`,
                },
            ],
        },

        {
            imagen: `/images/p4.png`,
            subtitulo: `SERIE SMARTMOVER`,
            titulo: `SM200+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `2000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `10°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `4.2 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `5.5 horas`,
                },
            ],
        },
    ],
};

const Galerias = {
    subtitulo: ``,
    titulo: `Así trabaja nuestra gama <br />SmartMover.`,
    descripcion: ``,
    fotos: [
        {
            imagen: `/images/foto1.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto4.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto3.png`,
            alt: ``,
            destacado: true,
        },
        {
            imagen: `/images/foto2.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto5.png`,
            alt: ``,
            destacado: false,
        },
    ],
};
</script>
