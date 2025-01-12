import dayjs from "dayjs";

export function useHelpers() {
    function getInitials(name: string) {
        if (!name) {
            throw new Error("Invalid name input.");
        }

        const trimmedName = name.trim();

        if (trimmedName === "") {
            return "--";
        }

        const words = trimmedName.split(" ");

        if (words.length > 1) {
            // Take the first character of each word
            return (words[0][0] + words[1][0]).toUpperCase();
        } else {
            // Take the first 2 characters of the single word
            return trimmedName.substring(0, 2).toUpperCase();
        }
    }

    function colorFromInitials(name: string) {
        const initials = getInitials(name)
        if (initials.length !== 2) {
            throw new Error("Initials must be exactly 2 characters.");
        }

        // Get the character codes for each initial
        const charCode1 = initials.charCodeAt(0);
        const charCode2 = initials.charCodeAt(1);

        // Normalize the character codes to a darker range
        // Multiplying by a factor less than 1 (e.g., 0.6) makes the colors darker
        const red = Math.floor((charCode1 % 64) + 50) * 0.6; // Adjusted for darker red
        const green = Math.floor((charCode2 % 64) + 50) * 0.6; // Adjusted for darker green
        const blue = Math.floor(((charCode1 + charCode2) % 128) + 100) * 0.6; // Ensuring rich blue

        // Create the RGB color string with darker tones
        const color = `rgb(${Math.floor(red)}, ${Math.floor(green)}, ${Math.floor(blue)})`;
        return color;
    }

    return { getInitials, colorFromInitials, dayjs };
}
