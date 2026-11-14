import type { TokenSet } from './types.js';

/**
 * Penyimpanan token aplikasi. Implementasikan untuk berbagi token antarproses/instance (Redis, database, KV),
 * supaya aplikasi serverless tidak meminta token baru di setiap permintaan.
 *
 * ```ts
 * const store: TokenStore = {
 *   get: async (key) => JSON.parse((await redis.get(key)) ?? 'null'),
 *   set: async (key, token, ttl) => { await redis.set(key, JSON.stringify(token), 'EX', ttl); },
 *   delete: async (key) => { await redis.del(key); },
 * };
 * ```
 */
export interface TokenStore {
  get(key: string): Promise<TokenSet | null | undefined> | TokenSet | null | undefined;
  /** `ttlSeconds`: umur token tersisa. */
  set(key: string, token: TokenSet, ttlSeconds: number): Promise<void> | void;
  delete(key: string): Promise<void> | void;
}

/** Penyimpanan bawaan di memori proses. */
export class MemoryTokenStore implements TokenStore {
  private readonly items = new Map<string, { token: TokenSet; until: number }>();

  get(key: string): TokenSet | null {
    const item = this.items.get(key);
    if (!item) return null;
    if (item.until <= Date.now()) {
      this.items.delete(key);
      return null;
    }
    return item.token;
  }

  set(key: string, token: TokenSet, ttlSeconds: number): void {
    this.items.set(key, { token, until: Date.now() + ttlSeconds * 1000 });
  }

  delete(key: string): void {
    this.items.delete(key);
  }
}
