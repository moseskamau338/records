import {  GlobalThemeOverrides } from "naive-ui";

export const colors = {
    // https://m2.material.io/design/color/dark-theme.html#properties
    dark: {
        50: "#3A3D44",
        100: "#383B41",
        200: "#36383F",
        300: "#31343B",
        400: "#2F3139",
        500: "#2A2D34",
        600: "#282A32",
        700: "#252830",
        800: "#21242B",
        900: "#151820",
    },
    olive: {
        50: "#FCFDFC",
        100: "#F8FAF8",
        200: "#EFF1EF",
        300: "#E7E9E7",
        400: "#DFE2DF",
        500: "#D7DAD7",
        600: "#CCCFCC",
        700: "#B9BCB8",
        800: "#898E87",
        900: "#7F847D",
        1000: "#60655F",
        1100: "#1D211C",
    },
    indigo: {
        50: "#FDFDFE",
        100: "#F7F9FF",
        200: "#EDF2FE",
        300: "#E1E9FF",
        400: "#D2DEFF",
        500: "#C1D0FF",
        600: "#ABBDF9",
        700: "#8DA4EF",
        800: "#3E63DD",
        900: "#3358D4",
        950: "#3A5BC7",
        1000: "#1F2D5C",
        alpha: {
            50: "rgb(0,0,128,.0078)",
            100: "rgb(0,64,255,.0314)",
            200: "rgb(0,71,241,.0706)",
            300: "rgb(0,68,255,.0.1176)",
            400: "rgb(0,68,255,.0.1765)",
            500: "rgb(0,62,255,.2431)",
            600: "rgb(0,55,237,.3294)",
            700: "rgb(0,52,220,.4471)",
            800: "rgb(0,49,210,.7569)",
            900: "rgb(0,46,201,.8000)",
            1000: "rgb(0,43,183,.7725)",
            1100: "rgb(0,16,70,.8784)",
        },
    },
};

export const lightThemeOverrides: GlobalThemeOverrides = {
    common: {
        primaryColor: colors.indigo[950],
        primaryColorHover: colors.indigo[800],
        primaryColorPressed: colors.indigo[950],
        borderColor: colors.olive[300],
    },
    Layout: {
        siderColor: "#F8FAF8",
    },
};

export const darkThemeOverrides: GlobalThemeOverrides = {
    common: {
        primaryColor: colors.indigo[500],
        primaryColorHover: colors.indigo[600],
        primaryColorPressed: colors.indigo[900],
        borderColor: colors.dark[300],
    },
    Layout: {
        siderColor: colors.dark[800],
        color: colors.dark[900],
        headerColor: colors.dark[900],
    },
    Dropdown: {
        color: colors.dark["300"],
    },
    Popover: {
        color: colors.dark["500"],
    },
    Input: {
        color: colors.dark["50"],
    },
};
