<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bidang;
use App\Models\Dokumen;

class DokumenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dokumen::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'bidang_id' => Bidang::factory(),
            'nama_dokumen' => $this->faker->word(),
            'nama_pekerjaan' => $this->faker->word(),
            'nama_perusahaan' => $this->faker->word(),
            'nama_pic' => $this->faker->word(),
            'nomor_pic' => $this->faker->word(),
            'email_pic' => $this->faker->word(),
            'berkas' => $this->faker->word(),
            'tgl_penerbitan' => $this->faker->date(),
            'tgl_kadaluarsa' => $this->faker->date(),
            'tgl_pengingat' => $this->faker->date(),
            'status_follow_up' => $this->faker->word(),
            'status_pengingat' => $this->faker->boolean(),
            'keterangan' => $this->faker->text(),
        ];
    }
}
