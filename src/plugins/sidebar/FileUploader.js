import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { Button, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const FileUploader = ( { audioUrl, onChangeUrl, onSelectAudio } ) => {

	return (
		<div className="ssp-file-uploader">
			{/* Text input for the transcript file URL */ }
			<TextControl
				value={ audioUrl }
				onChange={ onChangeUrl }
				placeholder={ __('Enter transcript file URL or upload a file', 'seriously-simple-transcripts') }
			/>

			{/* Media upload button for selecting the transcript file */ }
			<MediaUploadCheck>
				<MediaUpload
					onSelect={ onSelectAudio }
					allowedTypes={ ['text'] }
					render={ ( { open } ) => (
						<Button
							className={ 'button w-full' }
							onClick={ open } isSecondary>
							{ __('Upload File', 'seriously-simple-transcripts') }
						</Button>
					) }
				/>
			</MediaUploadCheck>
		</div>
	);
};

export default FileUploader;
