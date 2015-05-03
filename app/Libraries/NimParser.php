<?php namespace HMIF\Libraries;

class NimParser {

    public $nim;

    public $fakultas;
    public $prodi;
    public $program;
    public $angkatan;
    public $urutan;

    const FAKULTAS_TEKNIK = 'Teknik dan Ilmu Komputer';
    const FAKULTAS_EKONOMI = 'Ekonomi';
    const FAKULTAS_HUKUM = 'Hukum';
    const FAKULTAS_SOSPOL = 'Ilmu Sosial dan Politik';
    const FAKULTAS_DESAIN = 'Desain';
    const FAKULTAS_SASTRA = 'Sastra';

    const TEKNIK_IF = 'Teknik Informatika';
    const TEKNIK_TEKOM = 'Teknik Komputer';
    const TEKNIK_INDUSTRI = 'Teknik Industri';
    const TEKNIK_ARSITEK = 'Arsitektur';
    const TEKNIK_MI = 'Manajemen Informasi';
    const TEKNIK_PWK = 'Perencanaan Wilayah dan Kota';
    const TEKNIK_KOMAK = 'Komputerisasi Akuntansi';
    const TEKNIK_SIPIL = 'Teknik Sipil';
    const TEKNIK_ELEKTRO = 'Teknik Elektro';
    const TEKNIK_SI = 'Sistem Informasi';

    const EKONOMI_AK = 'Akuntansi';
    const EKONOMI_MANAJEMEN = 'Manajemen';
    const EKONOMI_SYARIAH = 'Akuntansi Syariah';

    const HUKUM = 'Hukum';

    const SOSPOL_IK = 'Ilmu Komunikasi';
    const SOSPOL_HUBINT = 'Ilmu Hubungan Internasional';
    const SOSPOL_PEMERINTAHAN = 'Ilmu Pemerintahan';
    const SOSPOL_PR = 'Public Relationship';

    const DESAIN_DKV = 'Desain Komunikasi dan Visual';
    const DESAIN_INTERIOR = 'Desain Interior';

    const SASTRA_ING = 'Sastra Inggris';
    const SASTRA_JPG = 'Sastra Jepang';

    const UNDEFINED = 'Tidak Diketahui';

    private $mapping;

    public function __construct($nim)
    {
        $this->nim = $nim;

        $this->mapping = [
            //1 => [
                '01' => static::TEKNIK_IF,
                '02' => static::TEKNIK_TEKOM, // TEKOM
                '03' => static::TEKNIK_INDUSTRI, // TEKINDUSTRI
                '04' => static::TEKNIK_ARSITEK, // ARSITEK
                '05' => static::TEKNIK_MI, // MI
                '06' => static::TEKNIK_PWK, // WILKOT
                '08' => static::TEKNIK_TEKOM, // TEKOM D3
                '09' => static::TEKNIK_MI, // MI D3
                '10' => static::TEKNIK_KOMAK, // KOM AK D3
                '30' => static::TEKNIK_SIPIL, // TEKSIPIL
                '31' => static::TEKNIK_ELEKTRO, // ELEKTRO
                '40' => static::TEKNIK_SI, // SI
            //],

            //2 => [
                '11' => static::EKONOMI_AK, // AK
                '12' => static::EKONOMI_MANAJEMEN, // MANAJEMEN
                '41' => static::EKONOMI_SYARIAH, // AKSYARIAH
                '42', // MANAJEMENRS
                '13' => static::EKONOMI_AK, // AK D3
                '14', // MANPES D3
                '15', // KEUANGAN
            //],

            //3 => [
                '16' => static::HUKUM, // HUKUM
            //],

            //4 => [
                '18' => static::SOSPOL_IK, // IK
                '43' => static::SOSPOL_HUBINT, // ILMUHUBINT
                '17' => static::SOSPOL_PEMERINTAHAN, // ILMUPEMERINTAHAN
                '33' => static::SOSPOL_PR, // PUBLIC RELATION
            //],

            //5 => [
                '19' => static::DESAIN_DKV, // DKV
                '20' => static::DESAIN_INTERIOR, // INTERIOR
                '21' => static::DESAIN_DKV, // DKV D3
            //],

            //6 => [
                '37' => static::SASTRA_ING, // ING
                '38' => static::SASTRA_JPG, // JPG
            //]
        ];

        if (strlen($this->nim) === 8)
        {
            $fakultas = (int) $this->nim[0];
            $prodi = $this->nim[1] . '' . $this->nim[2];

            switch ($fakultas)
            {
                case 1: // TEKNIK
                    $this->fakultas = static::FAKULTAS_TEKNIK;
                    break;

                case 2: // EKONOMI
                    $this->fakultas = static::FAKULTAS_EKONOMI;
                    break;

                case 3: // HUKUM
                    $this->fakultas = static::FAKULTAS_HUKUM;
                    break;

                case 4: // SOSPOL
                    $this->fakultas = static::FAKULTAS_SOSPOL;
                    break;

                case 5: // DESAIN
                    $this->fakultas = static::FAKULTAS_DESAIN;
                    break;

                case 6: // SASTRA
                    $this->fakultas = static::FAKULTAS_SASTRA;
                    break;

                default:
                    $this->fakultas = static::UNDEFINED;
                    break;
            }

            if ($this->fakultas !== static::UNDEFINED)
            {
                $this->prodi = $this->mapping[ $prodi ];

                if (in_array($prodi, ['08', '09', '10', '13', '21']))
                {
                    $this->program = 'D3';
                }
                else
                {
                    $this->program = 'S1';
                }
            }
            else
            {
                $this->prodi = static::UNDEFINED;
            }

            $this->angkatan = (int) ($this->nim[3] . '' . $this->nim[4]);
            $this->urutan = (int) ($this->nim[5] . '' . $this->nim[6] . '' . $this->nim[7]);
        }
        else
        {
            $this->fakultas = static::UNDEFINED;
            $this->prodi = static::UNDEFINED;
        }
    }

    public function isValid()
    {
        $year = date('y');

        if($this->fakultas == static::UNDEFINED || $this->prodi == static::UNDEFINED || $this->angkatan > $year)
        {
            return false;
        }

        return true;
    }
}
