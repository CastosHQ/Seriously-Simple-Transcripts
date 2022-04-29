<?php

namespace SSP_Transcripts\Interfaces;

interface Integration {
	public function is_compatible();

	public function init();
}
