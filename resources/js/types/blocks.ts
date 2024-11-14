// Define possible field types for the schema
export type FieldType =
    | "text"
    | "number"
    | "select"
    | "checkbox"
    | "radio"
    | "date"
    | "time"
    | "datetime"
    | "textarea"
    | "integration" // Special component for integrations
    | "queryBuilder" // Special component for query builders
    | "codeEditor" // Special component for code editing
    | "fileUpload" // For file upload fields
    | "custom"; // Any other custom component

// Interface for options used in select, radio fields, etc.
export interface Option {
    label: string;
    value: any;
}

// Interface for validation rules for form fields
export interface ValidationRule {
    type: string; // e.g., 'required', 'minLength', 'maxValue', 'regex', etc.
    value?: any; // Value associated with the validation rule
    message?: string; // Custom error message
}

// Interface representing each field in the schema
export interface SchemaField {
    name: string; // Unique identifier for the field
    label: string; // Label displayed on the form
    type: FieldType; // Type of the form field
    component?: string; // Name of the custom component if 'type' is 'custom'
    required?: boolean; // Whether the field is required
    defaultValue?: any; // Default value of the field
    options?: Option[]; // Options for 'select', 'radio', or 'checkbox' fields
    validations?: ValidationRule[]; // Array of validation rules
    placeholder?: string; // Placeholder text for input fields
    helpText?: string; // Help text or tooltip for the field
    multiple?: boolean; // For fields that support multiple values (e.g., multi-select)
    disabled?: boolean; // Whether the field is disabled
    readonly?: boolean; // Whether the field is read-only
    hidden?: boolean; // Whether the field is hidden from the form
    // Additional properties as needed
}

// Interface representing the block structure
export interface Block {
    id: string; // Unique identifier for the block
    type: string; // Block type identifier (e.g., 'data-source', 'trigger', 'code', etc.)
    displayName: string; // User-friendly name of the block
    description: string; // Brief description of the block's functionality
    image: string; // URL or path to the block's image or logo
    schema: SchemaField[]; // Array of schema fields for configuring the block
    category?: string; // Category under which the block falls (e.g., 'Data Sources', 'Triggers')
    isDeprecated?: boolean; // Indicates if the block is deprecated
    version?: string; // Version of the block
    tags?: string[]; // Tags for searching or grouping blocks
    // Any other custom properties
}
