import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface AppDetails {
  id: string;
  name_slug: string;
  name: string;
  auth_type: string;
  description: string;
  img_src: string;
  custom_fields_json: string;
  categories: string[];
}

export interface DataSource {
  id: string;
  name: string;
  external_id: string;
  healthy: boolean;
  dead: boolean | null;
  app: AppDetails;
  created_at: string;
  updated_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
