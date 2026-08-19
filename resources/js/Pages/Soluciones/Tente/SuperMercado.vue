<template>
    <AppLayout>
        <Hero :slides="banners" />
        <TenteComponent />
        <DescripcionComponent :dataDescripcion="serviciosDescripcionData" />
        <LineasComponent :lineas="Lineas" />
        <!-- <GaleriaComponent :galerias="Galerias" /> -->
        <SeparateComponent />
        <ContactoComponent />
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Components/Hero.vue";
import ContactoComponent from "@/Components/Share/Atencion.vue";
import DescripcionComponent from "@/Components/Tente/Descripcion.vue";
import TenteComponent from "@/Components/Share/Tente.vue";
import SeparateComponent from "@/Components/Share/Separate.vue";
import LineasComponent from "@/Components/Share/Tente/Lineas.vue";
// import GaleriaComponent from "@/Components/Share/MasterMover/Galeria.vue";
const banners = [
    {
        id: 1,
        image: "/images/bgt1.png",
        imageM: "/images/bgt1.png",
        title: "Haz que tu supermercado <br />avance mejor",
        subtitle: "Sector Supermercados",
        description: `Ruedas TENTE para carros y equipos de supermercado, diseñadas para un <br />movimiento suave, seguro y duradero.`,
        boton: ``,
        link: ``,
    },
];

const serviciosDescripcionData = {
    imagen: `supe.png`,
    etiqueta: `Supermercados`,
    title: `Soluciones de movilidad para supermercados`,
    descripcion: `<p>Los carros de supermercado requieren soluciones de movilidad confiables para garantizar un desplazamiento seguro, estable y eficiente durante jornadas de uso intensivo. TENTE ofrece ruedas y componentes especializados para carros, equipos de transporte y sistemas de movilidad dentro del sector retail.</p> <p>Nuestras soluciones incluyen ruedas con zapata de freno integrada y sistemas de seguimiento lateral que facilitan la maniobrabilidad y mantienen el equipo bajo control. Además, las ruedas para pasillos móviles ofrecen un funcionamiento eficiente, limpieza sencilla de los rieles y un reemplazo práctico, contribuyendo a reducir tiempos de mantenimiento y asegurar la continuidad operativa.</p>`,
};

const Lineas = {
    subtitulo: ``,
    titulo: `Movimiento seguro, <br />operación eficiente`,
    descripcion: `Para supermercados, almacenes y logística: movilidad, estabilidad y resistencia para una operación más eficiente.`,
    productos: [
        {
            imagen: `/images/t1.png`,
            subtitulo: `SERIE STORA`,
            titulo: `Rueda giratoria con Freno de rueda 125 mm`,
            items: [
                {
                    titulo: `Modelo`,
                    descripcion: `<span>QMP</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `125 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `80 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo y giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t2.png`,
            subtitulo: `SERIE STORA`,
            titulo: `Rueda giratoria 125 mm`,
            items: [
                {
                    titulo: `Modelo`,
                    descripcion: `<span>QMP</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `125 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `100 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo y giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t3.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Rueda giratoria 125 mm`,
            items: [
                {
                    titulo: `Modelo`,
                    descripcion: `<span>QAP</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `125 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `60 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t4.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Rueda giratoria  100 mm`,
            items: [
                {
                    titulo: `Modelo`,
                    descripcion: `<span>PJP</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `125 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `100 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
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
