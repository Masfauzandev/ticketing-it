<?php

namespace App\Services;

/**
 * Business logic untuk modul Management Asset IT.
 */
class AssetService
{
    /**
     * Generate kode aset unik (contoh: AST-LPT-0001)
     */
    public function generateAssetCode(string $categoryPrefix): string
    {
        // TODO: Implement auto-increment asset code
        return 'AST-' . $categoryPrefix . '-' . str_pad(1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Assign aset ke user.
     */
    public function assignAsset(int $assetId, int $userId): void
    {
        // TODO: Implement asset assignment logic
    }

    /**
     * Kembalikan aset dari user.
     */
    public function returnAsset(int $assignmentId): void
    {
        // TODO: Implement asset return logic
    }
}
