import { addFilter } from '@wordpress/hooks';
import { PanelBody } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import { useDispatch, useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import FileUploader from './FileUploader';

// Function to create the new PanelBody
const AdditionalPanelBody = () => {

  const editor = useSelect(( select ) => select('core/editor'));
  const postMeta = editor.getEditedPostAttribute('meta');

  if ( ! postMeta ) {
    return;
  }
  const { editPost } = useDispatch('core/editor');

  const setPostMeta = ( fieldName, value ) => {
    editPost({
      meta: {
        [ fieldName ]: value,  // Set the value for the post meta field
      },
    });
  };
  const transcriptFileMeta = postMeta.transcript_file || '';
  const [transcriptFile, setTranscriptFile] = useState(transcriptFileMeta);
  const [isSectionOpen, setSectionOpen] = useState(true);

  const handleFieldChange = ( fieldName, value, triggerUpdate ) => {
    // Callbacks map
    const setCallbacks = {
      transcript_file: setTranscriptFile,
    };

    setPostMeta(fieldName, value);

    setCallbacks[ fieldName ]?.(value); // Set the local value

    // Trigger event to update standard meta fields
    if ( triggerUpdate ) {
      document.dispatchEvent(new CustomEvent('changedSSPGutField', {
        'detail': { field: fieldName, value: value },
      }));
    }
  };

  useEffect(() => {
    const handleChangeSSPField = ( event ) => {
      handleFieldChange(event.detail.field, event.detail.value);
    };

    // Listen the standard meta field changed event
    document.addEventListener('changedSSPField', handleChangeSSPField);

    // Cleanup the event listener when the component unmounts
    return () => {
      document.removeEventListener('changedSSPField', handleChangeSSPField);
    };
  }, []);

  return (
    <PanelBody>
      <h2
        className={ 'ssp-accordion ' + ( isSectionOpen ? 'open' : '' ) }
        onClick={ () => setSectionOpen( ! isSectionOpen) }
        aria-expanded={ isSectionOpen }
      >
        { __('Transcript file', 'seriously-simple-transcripts') }
      </h2>
      { isSectionOpen && (
        <div className="ssp-sidebar-content">
          <div className="ssp-sidebar-field-section">
            <FileUploader
              audioUrl={ transcriptFile }
              onChangeUrl={ ( value ) => handleFieldChange('transcript_file', value, true) }
              onSelectAudio={ ( media ) => handleFieldChange('transcript_file', media.url, true) }
            />
            <div className={ 'description' }>
              <div>{ __('Upload the transcript file or paste the file URL here.', 'seriously-simple-transcripts') }</div>
              <div>{ __('To show the transcript file in the feed, please use SRT, VTT, JSON, HTML or TXT files.', 'seriously-simple-transcripts') }</div>
            </div>

          </div>

        </div>
      ) }
    </PanelBody>
  );
};

// Register the filter to inject PanelBody
addFilter(
  'ssp.episodeMetaSidebarEnd',
  'ssstats/additional-panel-body',
  () => <AdditionalPanelBody/>,
);
