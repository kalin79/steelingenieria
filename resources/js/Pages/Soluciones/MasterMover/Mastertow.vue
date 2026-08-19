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
        image: "/images/bs2.png",
        imageM: "/images/bs2.png",
        icono: "/images/kg.svg",
        kilos: `hasta 20,000 kg.`,
        title: "MasterTow",
        subtitle: "",
        description: `Remolcadores eléctricos de alta capacidad para mover <br />hasta 20.000 kg con facilidad.`,
        boton: ``,
        link: ``,
    },
];

const caracteristicas = {
    subtitulo: `MasterTow`,
    titulo: `La solución inteligente para el remolque <br />de cargas de gran capacidad`,
    descripcion: `MasterTow combina potencia y seguridad para mover cargas de hasta 20 toneladas con un rendimiento confiable, incluso en pendientes.`,
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
            icono: `/images/Sicon9.svg`,
            descripcion: `Operación sin necesidad de licencia`,
        },
        {
            icono: `/images/Sicon4.svg`,
            descripcion: `Elimina la manipulación manual de cargas`,
        },
        {
            icono: `/images/Sicon5.svg`,
            descripcion: `Transporte seguro de cargas de hasta 20 toneladas`,
        },
        {
            icono: `/images/Sicon6.svg`,
            descripcion: `Rendimiento confiable en interiores y exteriores`,
        },
        {
            icono: `/images/Sicon10.svg`,
            descripcion: `Conexión sencilla mediante pasador de remolque`,
        },
        {
            icono: `/images/Sicon11.svg`,
            descripcion: `Disponible con control remoto y soluciones AGV`,
        },
    ],
};

const Lineas = {
    subtitulo: ``,
    titulo: `Explore la gama <br />MasterTow`,
    descripcion: `Tecnología de arrastre eléctrico para mover hasta 20.000 kg con mayor seguridad y productividad.`,
    productos: [
        {
            imagen: `/images/p5.png`,
            subtitulo: `SERIE MASTERTOW`,
            titulo: `TOW200`,
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
                    descripcion: `16.6 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `5.5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p6.png`,
            subtitulo: `SERIE MASTERTOW`,
            titulo: `TOW300`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `3000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `10°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `11.8 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `5.5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p7.png`,
            subtitulo: `SERIE MASTERTOW`,
            titulo: `TOW600`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `6000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `10°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `8.5 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `7.5 horas`,
                },
            ],
        },

        {
            imagen: `/images/p8.png`,
            subtitulo: `SERIE MASTERTOW`,
            titulo: `TOW600 ES`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `6000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `10°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `8.5 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `7.5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p9.png`,
            subtitulo: `SERIE MASTERTOW`,
            titulo: `TOW800 ES`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `8000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `10°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `6.5 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `7.5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p10.png`,
            subtitulo: `SERIE MASTERTOW`,
            titulo: `TOW1000 ES`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `10000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `10.2 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `7.5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p11.png`,
            subtitulo: `SERIE MASTERTOW`,
            titulo: `TOW1200 ES`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `12000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `8.6 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `7.5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p12.png`,
            subtitulo: `SERIE MASTERTOW`,
            titulo: `TOW1500 ES`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `15000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `6.9 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `7.5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p13.png`,
            subtitulo: `SERIE MASTERTOW`,
            titulo: `TOW2000 ES`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `20000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `5.9 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `8.5 horas`,
                },
            ],
        },
    ],
};

const Galerias = {
    subtitulo: ``,
    titulo: `Así trabaja nuestra gama <br />MasterTow`,
    descripcion: ``,
    fotos: [
        {
            imagen: `/images/foto6.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto9.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto8.png`,
            alt: ``,
            destacado: true,
        },
        {
            imagen: `/images/foto7.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto10.png`,
            alt: ``,
            destacado: false,
        },
    ],
};
</script>
