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
        image: "/images/bs3.png",
        imageM: "/images/bs3.png",
        icono: "/images/kg.svg",
        kilos: `hasta 20,000 kg.`,
        title: "MasterTug",
        subtitle: "",
        description: `Remolcadores peatonales compactos, potentes y fáciles <br />de usar para el movimiento controlado de cargas de hasta <br />20.000 kg.`,
        boton: ``,
        link: ``,
    },
];

const caracteristicas = {
    subtitulo: `MasterTug`,
    titulo: `Arrastradores eléctricos compactos <br />para un control total`,
    descripcion: `MasterTug mueve cargas de hasta 20 toneladas con máxima precisión. Su diseño compacto ofrece un control seguro para operar en espacios reducidos, interiores, exteriores y pendientes.`,
    items: [
        {
            icono: `/images/Sicon1.svg`,
            descripcion: `Baterías intercambiables para operación continua 24/7`,
        },
        {
            icono: `/images/Sicon12.svg`,
            descripcion: `Impulsa la eficiencia operativa`,
        },
        {
            icono: `/images/Sicon13.svg`,
            descripcion: `Reduce el tiempo de inactividad`,
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
            icono: `/images/Sicon14.svg`,
            descripcion: `Máquinas compactas para espacios reducidos`,
        },
        {
            icono: `/images/Sicon15.svg`,
            descripcion: `Alternativa flexible a la MHE tradicional`,
        },
        {
            icono: `/images/Sicon8.svg`,
            descripcion: `Conexiones hidráulicas seguras para una operación confiable`,
        },
    ],
};

const Lineas = {
    subtitulo: ``,
    titulo: `Explore la gama <br />MasterTug`,
    descripcion: `Tecnología de arrastre eléctrico para mover hasta 20.000 kg con mayor seguridad y productividad.`,
    productos: [
        {
            imagen: `/images/p14.png`,
            subtitulo: `SERIE MASTERTUG`,
            titulo: `MT200`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `2,000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `10.6 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `3.75 horas`,
                },
            ],
        },
        {
            imagen: `/images/p15.png`,
            subtitulo: `SERIE MASTERTUG`,
            titulo: `MT300+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `3,000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `11.7 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `5 horas`,
                },
            ],
        },
        {
            imagen: `/images/p16.png`,
            subtitulo: `SERIE MASTERTUG`,
            titulo: `MT400+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `4,000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `12.2 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `7 horas`,
                },
            ],
        },

        {
            imagen: `/images/p17.png`,
            subtitulo: `SERIE MASTERTUG`,
            titulo: `MT600+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `6000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `8.4 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `7 horas`,
                },
            ],
        },
        {
            imagen: `/images/p18.png`,
            subtitulo: `SERIE MASTERTUG`,
            titulo: `MT800+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `8,000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `11.7 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `6 horas`,
                },
            ],
        },
        {
            imagen: `/images/p19.png`,
            subtitulo: `SERIE MASTERTUG`,
            titulo: `MT1000+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `10,000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `9.5 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `6 horas`,
                },
            ],
        },
        {
            imagen: `/images/p20.png`,
            subtitulo: `SERIE MASTERTUG`,
            titulo: `MT1200+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `12,000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `8 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `6 horas`,
                },
            ],
        },
        {
            imagen: `/images/p21.png`,
            subtitulo: `SERIE MASTERTUG`,
            titulo: `MT1500+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `15,000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `6.5 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `6 horas`,
                },
            ],
        },
        {
            imagen: `/images/p22.png`,
            subtitulo: `SERIE MASTERTUG`,
            titulo: `MT2000+`,
            items: [
                {
                    icon: `/images/picon1.svg`,
                    titulo: `Capacidad de carga`,
                    descripcion: `20,000 kg`,
                },
                {
                    icon: `/images/picon2.svg`,
                    titulo: `Pendiente máxima`,
                    descripcion: `8°`,
                },
                {
                    icon: `/images/picon3.svg`,
                    titulo: `Autonomía`,
                    descripcion: `5.1 km`,
                },
                {
                    icon: `/images/picon4.svg`,
                    titulo: `Tiempo de carga`,
                    descripcion: `7 horas`,
                },
            ],
        },
    ],
};

const Galerias = {
    subtitulo: ``,
    titulo: `Así trabaja nuestra gama <br />MasterTug`,
    descripcion: ``,
    fotos: [
        {
            imagen: `/images/foto11.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto14.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto13.png`,
            alt: ``,
            destacado: true,
        },
        {
            imagen: `/images/foto12.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto15.png`,
            alt: ``,
            destacado: false,
        },
    ],
};
</script>
